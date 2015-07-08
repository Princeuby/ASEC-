-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`department`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`department` ;

CREATE TABLE IF NOT EXISTS `mydb`.`department` (
  `dept_name` VARCHAR(45) NOT NULL,
  `number_of_shift` INT NOT NULL,
  PRIMARY KEY (`dept_name`),
  UNIQUE INDEX `dept_name_UNIQUE` (`dept_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`security_officer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`security_officer` ;

CREATE TABLE IF NOT EXISTS `mydb`.`security_officer` (
  `officer_id` VARCHAR(20) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `middle_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `gender` VARCHAR(8) NOT NULL,
  `date_of_birth` DATE NULL,
  `rank` VARCHAR(45) NOT NULL,
  `dept_name` VARCHAR(45) NULL,
  `designation` VARCHAR(45) NOT NULL,
  `office` VARCHAR(45) NULL,
  `date_of_emp` DATE NULL,
  `date_of_res` DATE NULL,
  `education_level` VARCHAR(50) NULL,
  `focus_area` VARCHAR(100) NULL,
  `school` VARCHAR(100) NULL,
  `password` VARCHAR(250) NOT NULL,
  `leave_status` TINYINT(1) NOT NULL,
  `officer_status` TINYINT(1) NOT NULL,
  PRIMARY KEY (`officer_id`),
  UNIQUE INDEX `officer_id_UNIQUE` (`officer_id` ASC),
  INDEX `sec_dept_name_idx` (`dept_name` ASC),
  CONSTRAINT `sec_dept_name`
    FOREIGN KEY (`dept_name`)
    REFERENCES `mydb`.`department` (`dept_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`contact_info`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`contact_info` ;

CREATE TABLE IF NOT EXISTS `mydb`.`contact_info` (
  `mobile phone` VARCHAR(15) NOT NULL,
  `home phone` VARCHAR(15) NULL,
  `business phone` VARCHAR(15) NULL,
  `email_address` VARCHAR(80) NULL,
  `street` VARCHAR(100) NOT NULL,
  `city` VARCHAR(50) NOT NULL,
  `lga` VARCHAR(80) NOT NULL,
  `state` VARCHAR(30) NOT NULL,
  `zip` VARCHAR(10) NOT NULL,
  `nationality` VARCHAR(30) NOT NULL,
  `officer_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`mobile phone`),
  UNIQUE INDEX `mobile phone_UNIQUE` (`mobile phone` ASC),
  INDEX `contact_officer_id_idx` (`officer_id` ASC),
  CONSTRAINT `contact_officer_id`
    FOREIGN KEY (`officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`emergency_contact`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`emergency_contact` ;

CREATE TABLE IF NOT EXISTS `mydb`.`emergency_contact` (
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  `email_addresss` VARCHAR(80) NULL,
  `relationship` VARCHAR(15) NOT NULL,
  `officer_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`first_name`, `last_name`, `phone_number`),
  INDEX `emerg_officer_id_idx` (`officer_id` ASC),
  CONSTRAINT `emerg_officer_id`
    FOREIGN KEY (`officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`leaves`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`leaves` ;

CREATE TABLE IF NOT EXISTS `mydb`.`leaves` (
  `leaves_id` INT NOT NULL AUTO_INCREMENT,
  `leave_type` VARCHAR(30) NOT NULL,
  `leave_comment` VARCHAR(200) NULL,
  `proceeding_date` DATE NOT NULL,
  `returning_date` DATE NULL,
  `entitled_days` INT NULL,
  `supervisor_id_leaves` VARCHAR(20) NULL,
  `recommendation` VARCHAR(500) NULL,
  `approved_status` TINYINT(1) NULL,
  `approved_date` DATE NULL,
  `comments` VARCHAR(500) NULL,
  `low_rank` TINYINT(1) NOT NULL,
  `officer_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`leaves_id`),
  UNIQUE INDEX `leaves_id_UNIQUE` (`leaves_id` ASC),
  INDEX `leave_officer_id_idx` (`officer_id` ASC),
  INDEX `supervisor_id_leaves_idx` (`supervisor_id_leaves` ASC),
  CONSTRAINT `leave_officer_id`
    FOREIGN KEY (`officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `supervisor_id_leaves`
    FOREIGN KEY (`supervisor_id_leaves`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`locations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`locations` ;

CREATE TABLE IF NOT EXISTS `mydb`.`locations` (
  `location` VARCHAR(45) NOT NULL,
  `morning` INT NOT NULL,
  `afternoon` INT NOT NULL,
  `night` INT NOT NULL,
  PRIMARY KEY (`location`),
  UNIQUE INDEX `location_UNIQUE` (`location` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`scheduling`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`scheduling` ;

CREATE TABLE IF NOT EXISTS `mydb`.`scheduling` (
  `week_start` DATE NOT NULL,
  `officer_id` VARCHAR(20) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `shift` VARCHAR(20) NOT NULL,
  `off_day_1` VARCHAR(45) NULL,
  `off_day_2` VARCHAR(45) NULL,
  `approved` TINYINT(1) NULL,
  `comments` VARCHAR(45) NULL,
  PRIMARY KEY (`officer_id`, `location`, `week_start`),
  INDEX `schedule_location_id_idx` (`location` ASC),
  CONSTRAINT `schedule_location_id`
    FOREIGN KEY (`location`)
    REFERENCES `mydb`.`locations` (`location`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `schedule_officer_id`
    FOREIGN KEY (`officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`portal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`portal` ;

CREATE TABLE IF NOT EXISTS `mydb`.`portal` (
  `id` INT NOT NULL,
  `date_opened` DATETIME NOT NULL,
  `portal_status` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`vacancy`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`vacancy` ;

CREATE TABLE IF NOT EXISTS `mydb`.`vacancy` (
  `vacancy_id` INT NOT NULL AUTO_INCREMENT,
  `position` VARCHAR(100) NOT NULL,
  `summary` VARCHAR(400) NOT NULL,
  `department` VARCHAR(50) NOT NULL,
  `education_level` VARCHAR(50) NOT NULL,
  `working_experience` VARCHAR(100) NOT NULL,
  `other_specifications` VARCHAR(150) NOT NULL,
  `opening_date` DATE NOT NULL,
  `closing_date` DATE NOT NULL,
  `vacancy_status` TINYINT(1) NOT NULL,
  UNIQUE INDEX `vacancy_id_UNIQUE` (`vacancy_id` ASC),
  PRIMARY KEY (`vacancy_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`application`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`application` ;

CREATE TABLE IF NOT EXISTS `mydb`.`application` (
  `applicant_id` INT NOT NULL AUTO_INCREMENT,
  `date_of_application` DATETIME NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `middle_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  `email_address` VARCHAR(80) NOT NULL,
  `application_letter` VARCHAR(400) NULL,
  `curriculum_vitae` VARCHAR(400) NULL,
  `vacancy_id` INT NOT NULL,
  `interview_status` TINYINT(1) NULL,
  `interview_date` DATE NULL,
  `interview_location` VARCHAR(200) NULL,
  `training_status` TINYINT(1) NULL,
  `training_date` DATE NULL,
  `training_location` VARCHAR(200) NULL,
  `applicant_success` TINYINT(1) NULL,
  `application_status` TINYINT(1) NOT NULL,
  `applicant_added` TINYINT(1) NOT NULL,
  PRIMARY KEY (`applicant_id`),
  UNIQUE INDEX `applicant_id_UNIQUE` (`applicant_id` ASC),
  INDEX `app_vacancy_id_idx` (`vacancy_id` ASC),
  CONSTRAINT `app_vacancy_id`
    FOREIGN KEY (`vacancy_id`)
    REFERENCES `mydb`.`vacancy` (`vacancy_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`next_of_kin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`next_of_kin` ;

CREATE TABLE IF NOT EXISTS `mydb`.`next_of_kin` (
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  `email_address` VARCHAR(80) NULL,
  `relationship_status` VARCHAR(15) NOT NULL,
  `officer_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`first_name`, `last_name`, `phone_number`),
  INDEX `kin_officer_id_idx` (`officer_id` ASC),
  CONSTRAINT `kin_officer_id`
    FOREIGN KEY (`officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`cab`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`cab` ;

CREATE TABLE IF NOT EXISTS `mydb`.`cab` (
  `car_number` VARCHAR(20) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `gender` VARCHAR(8) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `date_of_emp` DATE NOT NULL,
  `education_level` VARCHAR(45) NOT NULL,
  `car_type` VARCHAR(45) NOT NULL,
  `car_color` VARCHAR(45) NOT NULL,
  `driver_license` VARCHAR(45) NOT NULL,
  `license_plate_number` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`car_number`),
  UNIQUE INDEX `car_number_UNIQUE` (`car_number` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`validation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`validation` ;

CREATE TABLE IF NOT EXISTS `mydb`.`validation` (
  `validation_id` INT NOT NULL AUTO_INCREMENT,
  `visitor_type` VARCHAR(45) NOT NULL,
  `visitor_id` VARCHAR(20) NOT NULL,
  `visitor_address` VARCHAR(50) NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  `car_plate_number` VARCHAR(45) NULL,
  `purpose_of_visit` VARCHAR(50) NOT NULL,
  `whom_to_visit` VARCHAR(45) NOT NULL,
  `location_to_visit` VARCHAR(45) NOT NULL,
  `date_timeIn` DATETIME NOT NULL,
  `officer_id` VARCHAR(20) NOT NULL,
  `date_timeOut` DATETIME NOT NULL,
  PRIMARY KEY (`validation_id`),
  INDEX `valid_officer_id_idx` (`officer_id` ASC),
  UNIQUE INDEX `validation_id_UNIQUE` (`validation_id` ASC),
  CONSTRAINT `valid_officer_id`
    FOREIGN KEY (`officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`dorm_visit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`dorm_visit` ;

CREATE TABLE IF NOT EXISTS `mydb`.`dorm_visit` (
  `dorm_visit_id` INT NOT NULL AUTO_INCREMENT,
  `visitor_id` VARCHAR(15) NOT NULL,
  `visitor_name` VARCHAR(45) NOT NULL,
  `visitor_address` VARCHAR(45) NOT NULL,
  `whom_to_see` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  `room_number` VARCHAR(5) NOT NULL,
  `date_timeIn` DATETIME NOT NULL,
  `date_timeOut` DATETIME NOT NULL,
  `residence_hall` VARCHAR(15) NOT NULL,
  `officer_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`dorm_visit_id`),
  INDEX `dorm_officer_id_idx` (`officer_id` ASC),
  UNIQUE INDEX `dorm_visit_id_UNIQUE` (`dorm_visit_id` ASC),
  CONSTRAINT `dorm_officer_id`
    FOREIGN KEY (`officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`investigation_record`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`investigation_record` ;

CREATE TABLE IF NOT EXISTS `mydb`.`investigation_record` (
  `investigation_id` INT NOT NULL AUTO_INCREMENT,
  `offence_type` VARCHAR(45) NOT NULL,
  `offender_name` VARCHAR(45) NOT NULL,
  `offender_type` VARCHAR(45) NOT NULL,
  `time_of_offence` TIME NOT NULL,
  `date_of_offence` DATE NOT NULL,
  `location_of_offence` VARCHAR(45) NOT NULL,
  `source_of_information` VARCHAR(45) NOT NULL,
  `evidence` VARCHAR(45) NOT NULL,
  `investigation_report` VARCHAR(45) NOT NULL,
  `disciplinary_measure` VARCHAR(45) NOT NULL,
  `recommendation` VARCHAR(500) NOT NULL,
  `investigation_officer_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`investigation_id`),
  UNIQUE INDEX `investigation_id_UNIQUE` (`investigation_id` ASC),
  INDEX `inv_officer_id_idx` (`investigation_officer_id` ASC),
  CONSTRAINT `inv_officer_id`
    FOREIGN KEY (`investigation_officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`case`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`case` ;

CREATE TABLE IF NOT EXISTS `mydb`.`case` (
  `case_id` INT NOT NULL AUTO_INCREMENT,
  `case_type` VARCHAR(30) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `gender` VARCHAR(45) NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  `home_address` VARCHAR(45) NOT NULL,
  `office_address` VARCHAR(45) NULL,
  `department` VARCHAR(45) NULL,
  `incident_description` VARCHAR(500) NOT NULL,
  `investigation_id` INT NOT NULL,
  PRIMARY KEY (`case_id`),
  UNIQUE INDEX `statement_id_UNIQUE` (`case_id` ASC),
  INDEX `state_investigation_id_idx` (`investigation_id` ASC),
  CONSTRAINT `state_investigation_id`
    FOREIGN KEY (`investigation_id`)
    REFERENCES `mydb`.`investigation_record` (`investigation_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`activity_report`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`activity_report` ;

CREATE TABLE IF NOT EXISTS `mydb`.`activity_report` (
  `report_id` INT NOT NULL AUTO_INCREMENT,
  `officer_id` VARCHAR(45) NOT NULL,
  `date_timeIn` DATETIME NOT NULL,
  `date_timeOut` DATETIME NULL,
  `shift` VARCHAR(45) NOT NULL,
  `previous_officer_id` VARCHAR(45) NOT NULL,
  `next_officer_id` VARCHAR(45) NULL,
  PRIMARY KEY (`report_id`),
  UNIQUE INDEX `report_id_UNIQUE` (`report_id` ASC),
  INDEX `act_next_officer_id_idx` (`next_officer_id` ASC),
  INDEX `act_previous_officer_id_idx` (`previous_officer_id` ASC),
  CONSTRAINT `act_next_officer_id`
    FOREIGN KEY (`next_officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `act_previous_officer_id`
    FOREIGN KEY (`previous_officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`incident`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`incident` ;

CREATE TABLE IF NOT EXISTS `mydb`.`incident` (
  `incident_id` INT NOT NULL AUTO_INCREMENT,
  `incident_type` VARCHAR(45) NOT NULL,
  `incident_time` DATETIME NOT NULL,
  `entry_report` VARCHAR(2000) NOT NULL,
  `report_id` INT NULL,
  PRIMARY KEY (`incident_id`),
  UNIQUE INDEX `incident_id_UNIQUE` (`incident_id` ASC),
  INDEX `report_id_idx` (`report_id` ASC),
  CONSTRAINT `report_id`
    FOREIGN KEY (`report_id`)
    REFERENCES `mydb`.`activity_report` (`report_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`shifts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`shifts` ;

CREATE TABLE IF NOT EXISTS `mydb`.`shifts` (
  `shift` VARCHAR(45) NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  PRIMARY KEY (`start_time`, `end_time`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`officer_locations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`officer_locations` ;

CREATE TABLE IF NOT EXISTS `mydb`.`officer_locations` (
  `officer_id` VARCHAR(45) NOT NULL,
  `officer_location` VARCHAR(45) NOT NULL,
  `last_shift` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`officer_id`, `officer_location`),
  INDEX `loc_location_idx` (`officer_location` ASC),
  CONSTRAINT `loc_officer_id`
    FOREIGN KEY (`officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `loc_location`
    FOREIGN KEY (`officer_location`)
    REFERENCES `mydb`.`locations` (`location`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`department`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('Surveillance', 3);
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('K9', 3);
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('Internal Affairs', 3);
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('Special Squad', 2);
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('Traffic', 3);
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('Communication', 3);
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('Equine', 2);
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('Tailoring', 2);
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('Training ', 2);
INSERT INTO `mydb`.`department` (`dept_name`, `number_of_shift`) VALUES ('Aerial Research', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`security_officer`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S01', 'Alice', '', 'Raymond', 'Female', '1978-01-14', 'Supervisor', 'Surveillance', 'Supervisor', 'AnS', '2001-11-09', NULL, 'Primary', 'Campus', 'SITC', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S02', 'Olayide', 'Sandra', 'Babalola', 'Female', '1978-11-12', 'CSO', NULL, 'CSO', 'AnS', '2004-07-12', NULL, 'University', 'AUN', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S03', 'Paul', 'Peter', 'Eledu', 'Male', '1970-01-23', 'Officer One', 'Surveillance', 'Rank and File', 'AnS', '2001-12-12', NULL, 'Secondary', 'EE', 'SBE', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S04', 'Emeka', 'Eze', 'Aminu', 'Male', '1990-08-14', 'Officer Three', 'Surveillance', 'Rank and File', 'AnS', '2002-06-13', NULL, 'Secondary', 'FF', 'SBE', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S05', 'Ubong', 'Mahmood', 'Ila', 'Male', '1994-07-02', 'ACSO', NULL, 'ACSO', 'POH', '2015-03-01', NULL, 'Graduate', 'School', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S06', 'Ezinwa', 'Aisha', 'Fatima', 'Female', '1994-04-12', 'Senior Supervisor', NULL, 'Senior Supervisor', 'POH', '2015-07-12', NULL, 'Graduate', 'Campus', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S07', 'Electoral', NULL, 'Committee', 'None', '0000-00-00', 'Committee', NULL, 'Committee', 'POH', '0000-00-00', NULL, 'None', 'School', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S08', 'Officer', NULL, 'Scheduler', 'None', '0000-00-00', 'Scheduler', NULL, 'Scheduler', 'POH', '0000-00-00', NULL, 'None', 'School', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S09', 'John', 'Pat', 'Michael', 'Male', NULL, 'Officer Three', NULL, 'Rank and File', 'E-Library', NULL, NULL, 'Degree', 'Biology', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S10', 'James', 'Patrick', 'Oduah', 'Male', NULL, 'Officer Three', NULL, 'Rank and File', 'EE', NULL, NULL, 'Degree', 'Biochemistry', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S11', 'Peter', 'Bitrus', 'Oke', 'Male', NULL, 'Officer Three', NULL, 'Rank and File', 'BB', NULL, NULL, 'Degree', 'Chemistry', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S12', 'Joel', 'Johnson', 'Chinedu', 'Male', NULL, 'Officer Three', NULL, 'Rank and File', 'Main Gate', NULL, NULL, 'Degree', 'English', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S13', 'Abbas', 'Bobby', 'Hassan', 'Male', NULL, 'Officer Three', NULL, 'Rank and File', 'North Campus Gate', NULL, NULL, 'Degree', 'Physics', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S14', 'Aisha', 'Idris', 'Aliyu', 'Female', NULL, 'Officer Three', NULL, 'Rank and File', 'CC', NULL, NULL, 'Degree', 'Mathematics', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S15', 'Amina', 'Zainab', 'Bello', 'Female', NULL, 'Officer Three', NULL, 'Rank and File', 'North Campus Gate', NULL, NULL, 'WAEC/JAMB', 'School', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S16', 'Aminu', 'Muhammed', 'Sadiki', 'Male', NULL, 'Officer Three', NULL, 'Rank and File', 'Campus Store', NULL, NULL, 'WAEC/JAMB', 'School', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S17', 'Paul', 'Eze', 'Emeka', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'Comencement Hall', NULL, NULL, 'WAEC/JAMB', 'School', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S18', 'Peter', 'Nnamdi', 'Pedro', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'EE', NULL, NULL, 'WAEC/JAMB', 'School', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S19', 'Jonathan', 'Celestine', 'Shalom', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'FF', NULL, NULL, 'OND', 'Law', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S20', 'Michael', 'Ogak', 'Nnandi', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'G.Volpi', NULL, NULL, 'OND', 'Statistics', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S21', 'Mikel', 'Bizzy', 'Orya', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'FF', NULL, NULL, 'OND', 'Electrical Engineering', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S22', 'Chizzy', 'Marcus', 'Chukwu', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'BB', NULL, NULL, 'OND', 'Mass Communications', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S23', 'Johnson', 'Caleb', 'Onyia', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'Main Gate', NULL, NULL, 'OND', 'Economics', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S24', 'Ezinwa', 'Ariahu', 'Abinya', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'E-Library', NULL, NULL, 'OND', 'Management', 'SBE', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S25', 'Matthew', 'David', 'Dave', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'Commencement Hall', NULL, NULL, 'OND', 'Geography', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S26', 'Elvis', 'Davis', 'Ene', 'Male', NULL, 'Officer Two', NULL, 'Rank and File', 'EE', NULL, NULL, 'OND', 'Literature Art', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S27', 'Charles', 'Roland', 'Doumbia', 'Male', NULL, 'Officer One', NULL, 'Rank and File', 'BB', NULL, NULL, 'OND', 'Computer Science', 'SITC', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S28', 'Tennyson', 'Cali', 'Mata', 'Male', NULL, 'Officer One', NULL, 'Rank and File', 'FF', NULL, NULL, 'HND', 'Computer Studies', 'SITC', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S29', 'Nonso', 'Joshua', 'Hulk', 'Male', NULL, 'Officer One', NULL, 'Rank and File', 'G.Volpi', NULL, NULL, 'HND', 'Statistics', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S30', 'Blessing', 'Egbe', 'Sanchez', 'Female', NULL, 'Officer One', NULL, 'Rank and File', 'CC', NULL, NULL, 'HND', 'Biology', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S31', 'Mercy', 'Daniel', 'Caleb', 'Female', NULL, 'Officer One', NULL, 'Rank and File', 'AA', NULL, NULL, 'HND', 'Mass Communications', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S32', 'Joey', 'Ogbe', 'Dimas', 'Female', NULL, 'Officer One', NULL, 'Rank and File', 'AA', NULL, NULL, 'HND', 'Chemistry', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S33', 'Lillian', 'Zeera', 'Morgan', 'Female', NULL, 'Officer One', NULL, 'Rank and File', 'DD', NULL, NULL, 'HND', 'Petroleum Chemistry', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S34', 'Esther', 'Megan', 'John', 'Female', NULL, 'Officer One', NULL, 'Rank and File', 'CC', NULL, NULL, 'Degree', 'English Literature', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `date_of_res`, `education_level`, `focus_area`, `school`, `password`, `leave_status`, `officer_status`) VALUES ('S35', 'Ruth', 'Joy', 'Paul', 'Female', NULL, 'Officer One', NULL, 'Rank and File', 'R.Volpi', NULL, NULL, 'Degree', 'Mass Communications', 'SAS', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu', 0, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`leaves`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`leaves` (`leaves_id`, `leave_type`, `leave_comment`, `proceeding_date`, `returning_date`, `entitled_days`, `supervisor_id_leaves`, `recommendation`, `approved_status`, `approved_date`, `comments`, `low_rank`, `officer_id`) VALUES (1, 'annual', NULL, '2014-12-07', '2014-12-21', 14, 'S01', 'He can go', 1, '2014-12-02', NULL, 1, 'S04');
INSERT INTO `mydb`.`leaves` (`leaves_id`, `leave_type`, `leave_comment`, `proceeding_date`, `returning_date`, `entitled_days`, `supervisor_id_leaves`, `recommendation`, `approved_status`, `approved_date`, `comments`, `low_rank`, `officer_id`) VALUES (2, 'annual', NULL, '2015-01-11', '2015-01-25', 14, 'S01', 'Let him Be', 1, '2015-01-09', 'Why must you go', 1, 'S03');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`locations`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('CAFETERIA', 2, 2, 2);
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('DORM AA', 3, 3, 3);
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('DORM BB', 4, 4, 4);
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('DORM CC', 4, 4, 4);
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('DORM DD', 4, 4, 4);
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('DORM EE', 3, 3, 3);
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('DORM FF', 3, 3, 3);
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('GABRIEL VOLPI', 3, 3, 3);
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('MAIN GATE', 5, 5, 5);
INSERT INTO `mydb`.`locations` (`location`, `morning`, `afternoon`, `night`) VALUES ('ROSARIO VOLPI', 3, 3, 3);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`scheduling`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`scheduling` (`week_start`, `officer_id`, `location`, `shift`, `off_day_1`, `off_day_2`, `approved`, `comments`) VALUES ('0000-00-00', 'S01', 'MAIN GATE', 'Night', NULL, NULL, NULL, NULL);
INSERT INTO `mydb`.`scheduling` (`week_start`, `officer_id`, `location`, `shift`, `off_day_1`, `off_day_2`, `approved`, `comments`) VALUES ('0000-00-00', 'S03', 'MAIN GATE', 'Night', NULL, NULL, NULL, NULL);
INSERT INTO `mydb`.`scheduling` (`week_start`, `officer_id`, `location`, `shift`, `off_day_1`, `off_day_2`, `approved`, `comments`) VALUES ('0000-00-00', 'S04', 'MAIN GATE', 'Night', NULL, NULL, NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`shifts`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`shifts` (`shift`, `start_time`, `end_time`) VALUES ('Morning', '06:00:00', '13:59:59');
INSERT INTO `mydb`.`shifts` (`shift`, `start_time`, `end_time`) VALUES ('Afternoon', '14:00:00', '19:59:59');
INSERT INTO `mydb`.`shifts` (`shift`, `start_time`, `end_time`) VALUES ('Night', '00:00:00', '05:59:59');
INSERT INTO `mydb`.`shifts` (`shift`, `start_time`, `end_time`) VALUES ('Night', '20:00:00', '23:59:59');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`officer_locations`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S03', 'MAIN GATE', 'Night');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S04', 'MAIN GATE', 'Night');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S09', 'CAFETERIA', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S10', 'CAFETERIA', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S11', 'CAFETERIA', 'Afternoon');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S12', 'GABRIEL VOLPI', 'Night');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S13', 'GABRIEL VOLPI', 'Night');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S14', 'GABRIEL VOLPI', 'Night');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S15', 'DORM AA', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S16', 'DORM AA', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S17', 'DORM AA', 'Night');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S18', 'DORM BB', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S19', 'DORM BB', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S20', 'DORM BB', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S21', 'DORM CC', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S22', 'DORM CC', 'Afternoon');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S23', 'DORM CC', 'Afternoon');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S24', 'DORM DD', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S25', 'DORM DD', 'Afternoon');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S26', 'DORM DD', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S27', 'DORM EE', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S28', 'DORM EE', 'Night');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S29', 'DORM EE', 'Night');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S30', 'DORM FF', 'Afternoon');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S31', 'DORM FF', 'Afternoon');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S32', 'DORM FF', 'Afternoon');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S33', 'ROSARIO VOLPI', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S34', 'ROSARIO VOLPI', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S35', 'ROSARIO VOLPI', 'Morning');
INSERT INTO `mydb`.`officer_locations` (`officer_id`, `officer_location`, `last_shift`) VALUES ('S01', 'MAIN GATE', 'Night');

COMMIT;

