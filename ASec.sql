-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`department` (
  `dept_name` VARCHAR(45) NOT NULL,
  `supervisor` VARCHAR(45) NOT NULL,
  `number_of_shift` INT NOT NULL,
  PRIMARY KEY (`dept_name`),
  UNIQUE INDEX `dept_name_UNIQUE` (`dept_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`security_officer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`security_officer` (
  `officer_id` VARCHAR(20) NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `middle_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `gender` VARCHAR(8) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `rank` VARCHAR(45) NOT NULL,
  `dept_name` VARCHAR(45) NOT NULL,
  `designation` VARCHAR(45) NOT NULL,
  `office` VARCHAR(45) NULL,
  `date_of_emp` DATE NOT NULL,
  `education_level` VARCHAR(50) NOT NULL,
  `focus_area` VARCHAR(100) NOT NULL,
  `school` VARCHAR(100) NOT NULL,
  `password` VARCHAR(250) NOT NULL,
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
CREATE TABLE IF NOT EXISTS `mydb`.`leaves` (
  `leaves_id` INT NOT NULL,
  `month_proceed` VARCHAR(30) NOT NULL,
  `leave_type` VARCHAR(30) NOT NULL,
  `proceeding_date` DATE NOT NULL,
  `returning_date` DATE NULL,
  `recommendation` VARCHAR(100) NOT NULL,
  `entitled_days` VARCHAR(20) NOT NULL,
  `supervisor` VARCHAR(45) NOT NULL,
  `approved_date` DATE NOT NULL,
  `approved_by` VARCHAR(45) NOT NULL,
  `comments` VARCHAR(100) NOT NULL,
  `officer_id` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`leaves_id`),
  UNIQUE INDEX `leaves_id_UNIQUE` (`leaves_id` ASC),
  INDEX `leave_officer_id_idx` (`officer_id` ASC),
  CONSTRAINT `leave_officer_id`
    FOREIGN KEY (`officer_id`)
    REFERENCES `mydb`.`security_officer` (`officer_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`location` (
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
CREATE TABLE IF NOT EXISTS `mydb`.`scheduling` (
  `officer_id` VARCHAR(20) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `shift` VARCHAR(20) NOT NULL,
  `day` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`officer_id`, `location`, `shift`, `day`),
  INDEX `schedule_location_id_idx` (`location` ASC),
  CONSTRAINT `schedule_location_id`
    FOREIGN KEY (`location`)
    REFERENCES `mydb`.`location` (`location`)
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
CREATE TABLE IF NOT EXISTS `mydb`.`vacancy` (
  `vacancy_id` INT NOT NULL AUTO_INCREMENT,
  `position` VARCHAR(100) NOT NULL,
  `department` VARCHAR(50) NOT NULL,
  `education_level` VARCHAR(50) NOT NULL,
  `working_experience` VARCHAR(100) NOT NULL,
  `other_specifications` VARCHAR(150) NOT NULL,
  UNIQUE INDEX `vacancy_id_UNIQUE` (`vacancy_id` ASC),
  PRIMARY KEY (`vacancy_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`application`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`application` (
  `applicant_id` INT NOT NULL AUTO_INCREMENT,
  `date_of_application` DATETIME NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `middle_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `gender` VARCHAR(8) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `phone_number` VARCHAR(15) NOT NULL,
  `email_address` VARCHAR(80) NULL,
  `street` VARCHAR(100) NOT NULL,
  `city` VARCHAR(50) NOT NULL,
  `lga` VARCHAR(80) NOT NULL,
  `state` VARCHAR(30) NOT NULL,
  `nationality` VARCHAR(30) NOT NULL,
  `education_level` VARCHAR(45) NOT NULL,
  `school` VARCHAR(100) NOT NULL,
  `focus area` VARCHAR(100) NOT NULL,
  `cover_letter` LONGBLOB NOT NULL,
  `curriculum vitae` LONGBLOB NOT NULL,
  `vacancy_id` INT NOT NULL,
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
  `recommendation` VARCHAR(45) NOT NULL,
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
CREATE TABLE IF NOT EXISTS `mydb`.`incident` (
  `incident_id` INT NOT NULL AUTO_INCREMENT,
  `incident_type` VARCHAR(45) NOT NULL,
  `entry_report` VARCHAR(500) NOT NULL,
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
CREATE TABLE IF NOT EXISTS `mydb`.`shifts` (
  `shift` VARCHAR(45) NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  PRIMARY KEY (`shift`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`department`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`department` (`dept_name`, `supervisor`, `number_of_shift`) VALUES ('Surveillance', 'Paul', 4);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`security_officer`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`security_officer` (`officer_id`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `rank`, `dept_name`, `designation`, `office`, `date_of_emp`, `education_level`, `focus_area`, `school`, `password`) VALUES ('S01', 'Alice', '', 'Raymond', 'Female', '1978-01-14', 'Officer', 'Surveillance', 'EE', 'AnS', '2001-11-09', 'Primary', 'Campus', 'SITC', '$2y$10$JSRZSLzqRLFbB9VPkSAcueA1lv/THhLMkb8f/zMwylO4gEt47eotu');

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

