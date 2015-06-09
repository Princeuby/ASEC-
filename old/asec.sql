-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2015 at 01:27 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asecdb`
--
CREATE DATABASE IF NOT EXISTS `asecdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `asecdb`;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE IF NOT EXISTS `application` (
  `Application_ID` int(20) NOT NULL AUTO_INCREMENT,
  `Date_of_Application` datetime NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Middle_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Marital Status` varchar(15) NOT NULL,
  `Religion` varchar(15) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email Address` varchar(45) NOT NULL,
  `Street` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `LGA` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Nationality` varchar(15) NOT NULL,
  `Postal_Address` varchar(45) NOT NULL,
  PRIMARY KEY (`Application_ID`),
  UNIQUE KEY `Recruitment ID_UNIQUE` (`Application_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`Application_ID`, `Date_of_Application`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `Date_of_Birth`, `Marital Status`, `Religion`, `Phone_Number`, `Email Address`, `Street`, `City`, `LGA`, `State`, `Nationality`, `Postal_Address`) VALUES
(1, '0000-00-00 00:00:00', 'Hamza', 'Fred', 'Julian', 'Male', '2015-03-02', 'widower', 'Free thinker', '08124563893', 'Hamza.julian@yahoo.com', 'Awele1 lane', 'Gombe', 'House', 'Gombe', 'Nigerian', '345678'),
(3, '2015-04-05 03:12:57', 'Dayo', 'Agbola', 'Tunde', 'male', '2015-04-02', 'single', 'Christain', '0809924720', 'dayo.tunde@aun.edu.ng', 'Jimeta', 'Numan', 'Yola', 'Adamawa', 'Nigeria', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `cab_driver`
--

CREATE TABLE IF NOT EXISTS `cab_driver` (
  `Car_Number` varchar(20) NOT NULL,
  `Car_Type` varchar(45) NOT NULL,
  `Car_color` varchar(45) NOT NULL,
  `License_Plate_Number` varchar(45) NOT NULL,
  `Driver_License` varchar(45) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Middle_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Marital_Status` varchar(15) NOT NULL,
  `Religion` varchar(15) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email_Address` varchar(45) NOT NULL,
  `Street` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `LGA` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Nationality` varchar(15) NOT NULL,
  `Postal Address` varchar(45) NOT NULL,
  PRIMARY KEY (`Car_Number`),
  UNIQUE KEY `Staff ID_UNIQUE` (`Car_Number`),
  UNIQUE KEY `License Plate Number_UNIQUE` (`License_Plate_Number`),
  UNIQUE KEY `Driver License_UNIQUE` (`Driver_License`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cab_driver`
--

INSERT INTO `cab_driver` (`Car_Number`, `Car_Type`, `Car_color`, `License_Plate_Number`, `Driver_License`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `Date_of_Birth`, `Marital_Status`, `Religion`, `Phone_Number`, `Email_Address`, `Street`, `City`, `LGA`, `State`, `Nationality`, `Postal Address`) VALUES
('008', 'Golf', 'Grey', 'AB-067D-Yol', '789902', 'Abdul', 'Sani', 'Ahmed', 'Male', '1985-03-02', 'Married', 'Islam', '09099927422', 'Abul.sani@aun.edu.ng', 'Jimeta', 'Yola', 'Nubi', 'Adamawa', 'Nigerian', '+234');

-- --------------------------------------------------------

--
-- Table structure for table `case_file`
--

CREATE TABLE IF NOT EXISTS `case_file` (
  `Case_ID` int(15) NOT NULL AUTO_INCREMENT,
  `Dorm` varchar(25) NOT NULL,
  `Room Number` int(11) NOT NULL,
  `RD_Name` varchar(45) NOT NULL,
  `Semester` varchar(15) NOT NULL,
  `Time_of_Incident` time NOT NULL,
  `Date_of_Incident` date NOT NULL,
  `Place_of_Incident` varchar(30) NOT NULL,
  `Incident_Description` varchar(70) NOT NULL,
  `Studen_ID` varchar(20) NOT NULL,
  `Staff_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`Case_ID`),
  UNIQUE KEY `Case ID_UNIQUE` (`Case_ID`),
  UNIQUE KEY `Student ID_UNIQUE` (`Studen_ID`),
  UNIQUE KEY `Staff ID_UNIQUE` (`Staff_ID`),
  KEY `Case_Student ID_idx` (`Studen_ID`),
  KEY `Case_Staff ID_idx` (`Staff_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `Faculty_ID` varchar(20) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Middle_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Marital_Status` varchar(15) NOT NULL,
  `Religion` varchar(15) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email_Address` varchar(45) NOT NULL,
  `Street` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `LGA` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Nationality` varchar(15) NOT NULL,
  `Postal_Address` varchar(45) NOT NULL,
  `Date_of_Employment` date NOT NULL,
  `Position` varchar(20) NOT NULL,
  `School` varchar(60) NOT NULL,
  PRIMARY KEY (`Faculty_ID`),
  UNIQUE KEY `Staff ID_UNIQUE` (`Faculty_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `girls_visitors`
--

CREATE TABLE IF NOT EXISTS `girls_visitors` (
  `Visitors_ID` varchar(15) NOT NULL,
  `Visitors_Name` varchar(45) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Whom_To_Visit` varchar(45) NOT NULL,
  `Room_Number` int(5) NOT NULL,
  `Time_In` datetime NOT NULL,
  `Residence_Hall` varchar(15) NOT NULL,
  PRIMARY KEY (`Visitors_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `girls_visitors`
--

INSERT INTO `girls_visitors` (`Visitors_ID`, `Visitors_Name`, `Phone_Number`, `Whom_To_Visit`, `Room_Number`, `Time_In`, `Residence_Hall`) VALUES
('A00014707', 'Emmanuel Neberi', '07068680621', 'John', 211, '2015-04-09 00:42:41', 'EE');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `Location` varchar(45) NOT NULL,
  `Morning` int(20) NOT NULL,
  `Afternoon` int(20) NOT NULL,
  `Night` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Location`, `Morning`, `Afternoon`, `Night`) VALUES
('MAIN GATE - RECEPTION', 1, 1, 1),
('MAIN GATE - FOOT PATH', 1, 1, 1),
('MAIN GATE- IN ENTRANCE', 2, 2, 2),
('MAIN GATE - IN BARRIER', 1, 1, 1),
('MAIN GATE - OUT ENTRANCE', 1, 1, 1),
('MAIN GATE - OUT BARIER', 1, 1, 1),
('MAINTENANCE GATE', 1, 1, 1),
('CLINIC', 1, 1, 1),
('NEW STORE', 1, 1, 1),
('USE ME', 1, 1, 1),
('FACULTY OFFICE', 1, 1, 1),
('BOREHOLE 2', 1, 1, 1),
('CONSTRUCTION GATE', 1, 1, 1),
('CAFETERIA', 2, 2, 2),
('GABRIEL VOLPI', 3, 3, 3),
('DORM AA', 3, 3, 3),
('DORM BB', 4, 4, 4),
('DORM CC', 4, 4, 4),
('DORM DD', 4, 4, 4),
('DORM EE', 3, 3, 3),
('DORM FF', 3, 3, 3),
('ROSARIO VOLPI', 3, 3, 3),
('LAST GATE', 1, 1, 1),
('ART & Science', 4, 4, 4),
('PETER OKOCHA', 3, 3, 3),
('E-Library', 3, 3, 3),
('GENERATOR PLANT', 1, 1, 1),
('DORM A', 1, 1, 1),
('DORM B', 1, 1, 1),
('DORM C', 1, 1, 1),
('DORM D', 1, 1, 1),
('DORM E', 1, 1, 1),
('DORM F', 1, 1, 1),
('DORM H', 1, 1, 1),
('DORM I', 1, 1, 1),
('BARCHELOR QUARTERS', 1, 1, 1),
('ICT', 2, 2, 2),
('CLUB HOUSE - GATE', 2, 2, 2),
('CLUB HOUSE - KITCHEN', 1, 1, 1),
('HOTEL - CONSTUCTION GATE', 1, 1, 1),
('HOTEL - MAIN GATE', 5, 5, 5),
('HOTEL - LOOBING DOOR', 1, 1, 1),
('HOTEL - INSIDE LOOBING', 1, 1, 1),
('HOTEL - UP FLOOR', 1, 1, 1),
('HOTEL - DOWN FLOOR', 1, 1, 1),
('HOTEL - BETWEEN CLUB AND HOTEL', 1, 1, 1),
('NNPC', 1, 1, 1),
('PRINTING PRESS', 3, 3, 3),
('BOREHOLE 1', 1, 1, 1),
('BOREHOLE 3', 1, 1, 1),
('(MD)PRINTING HOUSE', 2, 2, 2),
('MANAGEMENT 1', 2, 2, 2),
('MANAGEMENT 2', 2, 2, 2),
('MANAGEMENT 3', 2, 2, 2),
('MANAGEMENT 4', 2, 2, 2),
('MANAGEMENT 5', 2, 2, 2),
('MANAGEMENT 6', 2, 2, 2),
('MANAGEMNET 7', 2, 2, 2),
('BOT', 1, 1, 2),
('GARBAJO HOUSE', 1, 1, 2),
('TEN UNIT FLAT', 2, 2, 2),
('MBAMBA 1', 2, 2, 2),
('MBAMBA 2', 2, 2, 2),
('REPEATER STATION', 2, 2, 2),
('FOUNDERS HOUSE', 3, 3, 3),
('9 UNIT FLAT', 2, 2, 2),
('PRESIDENT GUEST', 2, 2, 2),
('16 UNIT FLAT', 2, 2, 2),
('NO. 4 GIREI STREET', 2, 2, 2),
('DOUGERIE', 2, 2, 2),
('TRANSIT CAMP', 2, 2, 2),
('8 UNIT FLAT', 2, 2, 2),
('15 UNIT FLAT', 2, 2, 2),
('GOTEL - MAINGATE', 4, 4, 4),
('GOTEL - POWER HOUSE', 2, 2, 2),
('GOTEL - TRASMITER ROOM', 1, 1, 1),
('GOTEL - STUDIO ROOM', 1, 1, 1),
('GOTEL - BEHIND CANTIN', 1, 1, 1),
('GOTEL - RECEPTION TV', 1, 1, 1),
('GOTEL - RECEPTION FM', 1, 1, 1),
('GOTEL - NEW BUILDING GATE', 1, 1, 1),
('PRINTING PRESS HOUSE', 2, 2, 2),
('AUN ACADEMY GATE', 4, 4, 4),
('PR AND COMMUNICATION', 1, 1, 1),
('HR/FINANCE', 1, 1, 1),
('COMMUNITY HALL', 1, 1, 1),
('PPDU', 1, 1, 1),
('AUN ACADEMY ELEMENTARY', 2, 2, 2),
('AUN ACADEMY 2ND GATE', 2, 2, 2),
('BOYS/GIRL HOSTEL', 1, 1, 3),
('PRICIPAL/CLINIC AND STORE', 1, 1, 1),
('QUIET DORM', 1, 1, 1),
('ACADEMY STAFF QUARTERS', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `next_of_kin`
--

CREATE TABLE IF NOT EXISTS `next_of_kin` (
  `First_Name` varchar(20) NOT NULL,
  `Middle_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Relationship_Status` varchar(15) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email_Address` varchar(45) NOT NULL,
  `Postal_Address` varchar(45) NOT NULL,
  `Street` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Nationality` varchar(15) NOT NULL,
  `Staff_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`First_Name`,`Middle_Name`,`Last_Name`),
  UNIQUE KEY `Staff ID_UNIQUE` (`Staff_ID`),
  KEY `Staff ID_idx` (`Staff_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `portal`
--

CREATE TABLE IF NOT EXISTS `portal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_opened` datetime NOT NULL,
  `portal_status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `portal`
--

INSERT INTO `portal` (`id`, `date_opened`, `portal_status`) VALUES
(4, '2015-04-05 21:37:39', 'Open');

-- --------------------------------------------------------

--
-- Table structure for table `scheduling`
--

CREATE TABLE IF NOT EXISTS `scheduling` (
  `Security_Staff_ID` varchar(20) NOT NULL,
  `Location` varchar(45) NOT NULL,
  `Shift` varchar(20) NOT NULL,
  `Day` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `security_staff`
--

CREATE TABLE IF NOT EXISTS `security_staff` (
  `Security_Staff_ID` varchar(20) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Middle_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Marital_Status` varchar(15) NOT NULL,
  `Religion` varchar(15) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email_Address` varchar(45) NOT NULL,
  `Street` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `LGA` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Nationality` varchar(15) NOT NULL,
  `Postal_Address` varchar(45) NOT NULL,
  `Date_of_Employment` date NOT NULL,
  `Rank` varchar(20) NOT NULL,
  `Department` varchar(30) NOT NULL,
  `Security_Staffcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Security_Staff_ID`),
  UNIQUE KEY `Staff ID_UNIQUE` (`Security_Staff_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `security_staff`
--

INSERT INTO `security_staff` (`Security_Staff_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `Date_of_Birth`, `Marital_Status`, `Religion`, `Phone_Number`, `Email_Address`, `Street`, `City`, `LGA`, `State`, `Nationality`, `Postal_Address`, `Date_of_Employment`, `Rank`, `Department`, `Security_Staffcol`) VALUES
('P1234', 'Uchente', 'Williams', 'Abdul', 'Male', '2010-03-28', 'single', 'islam', '07078936752', 'uche.abdul@aun.edu.ng', 'lane', 'Adure', 'Yola', 'Adamawa', 'Nigerian', '123456', '2015-03-03', 'sergant', 'Inventory', 'verified');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `Staff_ID` varchar(20) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Middle_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Marital_Status` varchar(15) NOT NULL,
  `Religion` varchar(15) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email Address` varchar(45) NOT NULL,
  `Street` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `LGA` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Nationality` varchar(15) NOT NULL,
  `Postal_Address` varchar(45) NOT NULL,
  `Date_of_Employment` date NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Department` varchar(30) NOT NULL,
  PRIMARY KEY (`Staff_ID`),
  UNIQUE KEY `Staff ID_UNIQUE` (`Staff_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `Student_ID` varchar(20) NOT NULL,
  `First_Name` varchar(15) NOT NULL,
  `Middle_Name` varchar(15) NOT NULL,
  `Last_Name` varchar(15) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Religion` varchar(25) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email_Address` varchar(45) NOT NULL,
  `Street` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `State` varchar(25) NOT NULL,
  `Nationality` varchar(25) NOT NULL,
  `Year_of_Admission` varchar(25) NOT NULL,
  `Graduation_Year` varchar(25) NOT NULL,
  `Status` varchar(12) NOT NULL,
  `Major` varchar(45) NOT NULL,
  `Concentration` varchar(40) DEFAULT NULL,
  `Minor` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Student_ID`),
  UNIQUE KEY `Student_ID_UNIQUE` (`Student_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `Date_of_Birth`, `Religion`, `Phone_Number`, `Email_Address`, `Street`, `City`, `State`, `Nationality`, `Year_of_Admission`, `Graduation_Year`, `Status`, `Major`, `Concentration`, `Minor`) VALUES
('A00014707', 'Emmanuel', 'Prince', 'Neberi', 'male', '2015-03-03', 'Christainity', '07068680621', 'emmanuel.neberi@aun.edu.ng', '4 Ihie Street ', 'Port Harcourt', 'Rivers', 'Nigeria', 'Fall 2011', 'Fall 2015', 'Enrolled', 'Information Systems', 'Security and Assurance', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `usertype` varchar(15) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(9) NOT NULL,
  `address` varchar(55) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `firstname`, `lastname`, `email`, `phone`, `usertype`, `date_of_birth`, `gender`, `address`) VALUES
('admin', 'ubong', 'Essien', 'Emmanuel', 'essien.emmanuel@aun.edu.n', '08059202132', 'admin', '2015-02-04', 'Male', 'Yola Byepass, Lamido Zubairu Way. Yola, Adamawa'),
('P0001', 'asec', 'Essien', 'Ubong', 'essien.ubong@aun.edu.ng', '08056921845', 'cso', '2015-03-03', 'male', 'Dorm EE, American University of Nigeria'),
('P0003', 'asec', 'Human ', 'Resource', 'human.resource@asec.com', '08059202132', 'hrpersonnel', '2015-04-03', 'female', 'American University of Nigeria Yola Nigeria'),
('P0912', 'asec', 'Wild', 'Ogin', 'wild.ogin@aun.edu.ng', '09038245896', 'personnel', '1979-04-02', 'female', '67 Cine'),
('P0945', 'asec', 'Remorse', 'Plots', 'remorse.plots@aun.edu.ng', '09067856743', 'personnel', '1976-03-19', 'female', '09 house lin'),
('P0981', 'asec', 'Chuks', 'Junek', 'chuks.junek@aun.edu.ng', '06547890937', 'personnel', '1967-08-09', 'male', '90 Great zone'),
('P0986', 'asec', 'Chris', 'Dotun', 'chris.dotun.@aun.edu.ng', '09024894809', 'personnel', '1978-11-11', 'male', '45 Vew Xrtre'),
('P0989', 'asec', 'optic', 'Dreams', 'optic.d@aun.edu.ng', '08037685674', 'personnel', '1967-08-15', 'female', '23 green house'),
('P1009', 'asec', 'Gbenga', 'Abel', 'Gbenga.abel@aun.edu.ng', '09876578986', 'personnel', '1988-04-04', 'male', '13 Creeks Lane'),
('P1010', 'asec', 'Dare', 'Philips', 'dare.philips@aun.edu.ng', '09086904758', 'personnel', '1988-05-04', 'male', '23 Zone Close'),
('P1019', 'asec', 'Sadiki', 'Ransom', 'sadiki.ransom@aun.edu.ng', '09076764328', 'personnel', '1989-09-05', 'male', '67 Fred Way'),
('P1067', 'asec', 'Peter', 'Alex', 'peter.alex@aun.edu.ng', '07067587546', 'personnel', '1989-08-08', 'male', '67 Yaloa Street'),
('P1068', 'asec', 'Dave', 'Fatima', 'dave.Fatima@aun.edu.ng', '07098765783', 'personnel', '1990-08-08', 'male', '4Wale Road'),
('P1089', 'asec', 'Cubat', 'pastor', 'cubat.pastor@aun.edu.ng', '07078976564', 'personnel', '1978-06-06', 'male', '09 Upper lane Zone'),
('P1092', 'asec', 'Wisdom', 'Osia', 'wisdom.ossai@aun.edu.ng', '09036789067', 'personnel', '1987-03-03', 'male', '89 Optic Road'),
('P1094', 'asec', 'Dorin', 'Yahaya-Alfa', 'dorin.yah-alfa@aun.edu.ng', '09878956749', 'personnel', '1989-05-05', 'male', 'Nihra 56'),
('P1222', 'asec', 'Sceany', 'Vinoe', 'sceany.vinoe@aun.edu.ng', '08035647898', 'personnel', '1977-08-20', 'female', '78 water clean'),
('P1235', 'asec', 'john', 'joel', 'john.joel@aun.edu.ng', '08011244212', 'personnel', '1994-12-04', 'male', 'jimeta'),
('P1236', 'asec', 'Vino', 'Tyi', 'vino.tyi@aun.edu.ng', '08135678898', 'personnel', '1988-08-06', 'male', '789 Kings Bridge'),
('P1267', 'asec', 'Ezinwa', 'Dariye', 'ezinwa.dariye@aun.edu.ng', '08076543521', 'personnel', '1967-04-12', 'male', '45 Dotun Avenue'),
('P1290', 'asec', 'Said', 'Sadiya', 'said.sadiya@aun.edu.ng', '09878654689', 'personnel', '1990-07-08', 'male', '90 Veue Islot'),
('P1324', 'asec', 'Essien', 'Dave', 'esssien.dave@aun.edu.ng', '09015678976', 'personnel', '1978-07-09', 'male', '17 Crisis Junction'),
('P1589', 'asec', 'Abi', 'Jpokl', 'abi.jpokl@aun.edu.ng', '08167987653', 'personnel', '1989-04-25', 'female', '89 Retreat Venue'),
('P1908', 'asec', 'John', 'John', 'john.j@aun.edu.ng', '07038678976', 'personnel', '1982-08-31', 'male', '704 Clean House'),
('P1989', 'asec', 'Wale', 'Zina', 'w.zina@aun.edu.ng', '07065467338', 'personnel', '1976-06-06', 'female', '67 Ekite Grod lane'),
('P2222', 'asec', 'Freda', 'Dariye', 'freda.dariye@aun.edu.ng', '08078989765', 'personnel', '1983-09-09', 'female', '14 williams Close'),
('P2356', 'asec', 'Buhari', 'Alfa', ' buhari.alfa@aun.edu.ng', '08078690904', 'personnel', '1983-08-12', 'male', '21 Turaki District'),
('P2387', 'asec', 'Church', 'Vent', 'vent.church@yahoomail.com', '07098765463', 'personnel', '1989-06-09', 'male', '12 sid creek'),
('P2578', 'asec', 'Robert', 'Ubong', 'robert.uby@aun.edu.ng', '08145690876', 'personnel', '1983-02-11', 'male', '67b Bridge Zone'),
('P3178', 'asec', 'Awa', 'Timothy', 'awa.timothy@aun.edu.ng', '08125647890', 'personnel', '1977-07-07', 'female', '45 Seraki Zone'),
('P3452', 'asec', 'Yinka', 'Bode', 'yinka.bode@aun.edu.ng', '07066869808', 'personnel', '1977-08-08', 'female', '78 Good Road'),
('P3490', 'asec', 'Broom', 'Christopher', 'chris.broom@aun.edu.ng', '03564908890', 'personnel', '1967-05-09', 'male', '87 june creek'),
('P4519', 'asec', 'Gideon', 'Christopher', 'godwin.c@aun.edu.ng', '08078765432', 'personnel', '1989-07-09', 'male', '142 Yola By Pass'),
('P4530', 'asec', 'Broonk', 'Dime', 'broonk.dime@aun.edu.ng', '09786478764', 'personnel', '1978-12-22', 'female', '234 brook water'),
('P4567', 'asec', 'Zorina', 'Abrue', 'zorina.abrue@aun.edu.ng', '08124567898', 'personnel', '1967-09-09', 'female', '78 Yhau close'),
('P4569', 'asec', 'Treank', 'Dayo', 't.dayo@aun.edu.ng', '09886758987', 'personnel', '1989-03-24', 'female', '45 kings Vent'),
('P4589', 'asec', 'Charles', 'Freda', 'charles.freda@aun.edu.ng', '08089765784', 'personnel', '1989-09-09', 'male', '45 Zone district'),
('P4598', 'asec', 'Okeke', 'Joshua', 'okeke.joshua@aun.edu.ng', '09088765674', 'personnel', '1982-12-31', 'female', '12 Xreem Goual'),
('P4659', 'asec', 'Norm', 'Vent', 'norm.vent@aun.edu.ng', '07096884632', 'personnel', '1980-01-11', 'female', '89 Water loo'),
('P5408', 'asec', 'Ted', 'Tooijk', 'ted.tooijk@aun.edu.ng', '08098766478', 'personnel', '1980-06-06', 'male', '786 York close'),
('P5409', 'asec', 'Godwin', 'Shehu', 'Godwin.s@aun.edu.ng', '07035789765', 'personnel', '1988-01-09', 'male', '90 Zone BB road'),
('P5469', 'asec', 'Nigeria', 'South', 'nigeria.s@aun.edu.ng', '08038567898', 'personnel', '1982-06-30', 'female', '09 Retina June'),
('P5643', 'asec', 'Zhanatte', 'Adeloye', 'zan.ade@aun.edu.ng', '08097189546', 'personnel', '1989-07-07', 'female', 'Plots 34 GRA Yola Road'),
('P5644', 'asec', 'Dreams', 'Dreams', 'dreams.d@aun.edu.ng', '08134589765', 'personnel', '1977-10-19', 'male', '78 Drean'),
('P5780', 'asec', 'Chuks', 'Seid', 'c.s@aun.edu.ng', '09097688976', 'personnel', '1985-08-08', 'male', '78 took fred'),
('P6708', 'asec', 'Hod', 'Silk', 'hood.silk@aun.edu.ng', '09098796785', 'personnel', '1978-01-10', 'male', '89 Vion lane'),
('P6709', 'asec', 'Brook', 'Doron', 'brook.doron@aun.edu.ng', '03456789035', 'personnel', '1988-09-09', 'male', '56 Giouk Venue'),
('P6789', 'asec', 'Ubong', 'Alman', 'ubong.alman@aun.edu.ng', '08067890989', 'personnel', '1978-08-08', 'male', '2 AUN drive Yola'),
('P7890', 'asec', 'Shehu', 'Yahaya', 'sheu.y@aun.edu.ng', '09078685690', 'personnel', '1978-09-04', 'female', '89 dorm Avenue'),
('P7895', 'asec', 'Vent', 'Side', 'Ven.side@aun.edu.ng', '08134567898', 'personnel', '1982-05-27', 'female', '78 norm Vent'),
('P7898', 'asec', 'Zhen Abu-Zahara', 'Tino', 'tino.g@aun.edu.ng', '08167894569', 'personnel', '1956-08-08', 'female', '568 Ihei street'),
('P9075', 'asec', 'Moron', 'Freda', 'moron.freda@aun.edu.ng', '08076546735', 'personnel', '1978-11-13', 'male', '67 Benue Clink'),
('P9077', 'asec', 'Great', 'Finny', 'great.finny@aun.edu.ng', '09878656790', 'personnel', '1956-04-12', 'male', '907 toukr Crisk'),
('P9087', 'asec', 'Ferdinand', 'Che', 'fredinand.che@aun.edu.ng', '08034578609', 'personnel', '1988-09-04', 'male', '90 Jimeta cristan');

-- --------------------------------------------------------

--
-- Table structure for table `validation`
--

CREATE TABLE IF NOT EXISTS `validation` (
  `Security_staff_ID` varchar(20) NOT NULL,
  `Student_ID` varchar(20) NOT NULL,
  `Car_Number` varchar(20) NOT NULL,
  `Faculty_ID` varchar(20) NOT NULL,
  `Staff_ID` varchar(20) NOT NULL,
  `Visitor_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`Security_staff_ID`,`Student_ID`,`Car_Number`,`Faculty_ID`,`Staff_ID`,`Visitor_ID`),
  UNIQUE KEY `Security staff ID_UNIQUE` (`Security_staff_ID`),
  UNIQUE KEY `Student ID_UNIQUE` (`Student_ID`),
  UNIQUE KEY `Car Number_UNIQUE` (`Car_Number`),
  UNIQUE KEY `Faculty ID_UNIQUE` (`Faculty_ID`),
  UNIQUE KEY `Staff ID_UNIQUE` (`Staff_ID`),
  UNIQUE KEY `Visitor ID_UNIQUE` (`Visitor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE IF NOT EXISTS `visitor` (
  `Visitor_ID` varchar(20) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Middle_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Gender` varchar(8) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Marital_Status` varchar(15) NOT NULL,
  `Religion` varchar(15) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Email_Address` varchar(45) NOT NULL,
  `Street` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `LGA` varchar(20) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Nationality` varchar(15) NOT NULL,
  `Work_Address` varchar(55) NOT NULL,
  `Car_Type` varchar(45) DEFAULT NULL,
  `Car_Color` varchar(45) DEFAULT NULL,
  `License_Plate_Number` varchar(45) DEFAULT NULL,
  `Security_Staff_ID` varchar(20) NOT NULL,
  `Visitorcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Visitor_ID`),
  UNIQUE KEY `Staff ID_UNIQUE` (`Visitor_ID`),
  UNIQUE KEY `Security Staff ID_UNIQUE` (`Security_Staff_ID`),
  UNIQUE KEY `License Plate Number_UNIQUE` (`License_Plate_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`Visitor_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `Date_of_Birth`, `Marital_Status`, `Religion`, `Phone_Number`, `Email_Address`, `Street`, `City`, `LGA`, `State`, `Nationality`, `Work_Address`, `Car_Type`, `Car_Color`, `License_Plate_Number`, `Security_Staff_ID`, `Visitorcol`) VALUES
('v001', 'Paul', 'Emmanuel', 'John', 'Male', '1994-08-28', 'Single', 'Christain', '09099378229', 'paul.john@aun.edu.ng', 'Jimeta', 'Yola', 'Numan', 'Adamawa', 'Nigerian', 'ABTI, Academy, Yola', NULL, NULL, NULL, 'P1234', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vistors_check`
--

CREATE TABLE IF NOT EXISTS `vistors_check` (
  `Visitor_ID` varchar(20) NOT NULL,
  `Date_of_Visit` datetime NOT NULL,
  `Whom_to_Visit` varchar(45) NOT NULL,
  `Visit_Location` varchar(45) NOT NULL,
  `Visitor_Tag` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Visitor_Tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vistors_check`
--

INSERT INTO `vistors_check` (`Visitor_ID`, `Date_of_Visit`, `Whom_to_Visit`, `Visit_Location`, `Visitor_Tag`) VALUES
('v001', '2015-04-03 04:31:57', 'Dean Fonkam', 'Arts and Sciences Building', 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `case_file`
--
ALTER TABLE `case_file`
  ADD CONSTRAINT `Case_Staff ID` FOREIGN KEY (`Staff_ID`) REFERENCES `security_staff` (`Security_Staff_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Case_Student ID` FOREIGN KEY (`Studen_ID`) REFERENCES `student` (`Student_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `next_of_kin`
--
ALTER TABLE `next_of_kin`
  ADD CONSTRAINT `Next_of Kin_Staff ID` FOREIGN KEY (`Staff_ID`) REFERENCES `security_staff` (`Security_Staff_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `validation`
--
ALTER TABLE `validation`
  ADD CONSTRAINT `Val_Car Number` FOREIGN KEY (`Car_Number`) REFERENCES `cab_driver` (`Car_Number`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Val_Faculty ID` FOREIGN KEY (`Faculty_ID`) REFERENCES `faculty` (`Faculty_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Val_Security Staff ID` FOREIGN KEY (`Security_staff_ID`) REFERENCES `security_staff` (`Security_Staff_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Val_Staff ID` FOREIGN KEY (`Staff_ID`) REFERENCES `staff` (`Staff_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Val_Student ID` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Val_Visitor ID` FOREIGN KEY (`Visitor_ID`) REFERENCES `visitor` (`Visitor_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `visitor`
--
ALTER TABLE `visitor`
  ADD CONSTRAINT `Vis_Security Staff ID` FOREIGN KEY (`Security_Staff_ID`) REFERENCES `security_staff` (`Security_Staff_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
