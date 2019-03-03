-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tms
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tms
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tms` DEFAULT CHARACTER SET utf8 ;
USE `tms` ;

-- -----------------------------------------------------
-- Table `tms`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`student` (
  `idstudent` INT NOT NULL AUTO_INCREMENT,
  `dob` DATE NOT NULL,
  `join_date` DATE NULL,
  `contact_no` VARCHAR(15) NULL,
  `parent_name` VARCHAR(255) NULL,
  `parent_contatct_no` VARCHAR(15) NULL,
  `address` VARCHAR(255) NULL,
  `notes` VARCHAR(255) NULL,
  `studentcol` VARCHAR(45) NULL,
  PRIMARY KEY (`idstudent`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`teacher`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`teacher` (
  `idteacher` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NULL,
  `lname` VARCHAR(45) NULL,
  `nic` VARCHAR(45) NULL,
  `join_date` DATE NULL,
  PRIMARY KEY (`idteacher`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`subject` (
  `idsubject` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `grade` VARCHAR(45) NULL,
  `syllabus_year` YEAR NULL,
  `medium` VARCHAR(45) NULL,
  PRIMARY KEY (`idsubject`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`class` (
  `idclass` INT NOT NULL AUTO_INCREMENT,
  `teacher_idteacher` INT NOT NULL,
  `hourly_rate` INT NULL,
  `name` VARCHAR(45) NULL,
  `subject_idsubject` INT NOT NULL,
  PRIMARY KEY (`idclass`, `teacher_idteacher`, `subject_idsubject`),
  INDEX `fk_class_teacher1_idx` (`teacher_idteacher` ASC),
  INDEX `fk_class_subject1_idx` (`subject_idsubject` ASC),
  CONSTRAINT `fk_class_teacher1`
    FOREIGN KEY (`teacher_idteacher`)
    REFERENCES `tms`.`teacher` (`idteacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_subject1`
    FOREIGN KEY (`subject_idsubject`)
    REFERENCES `tms`.`subject` (`idsubject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`enrolment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`enrolment` (
  `idenrolment` INT NOT NULL AUTO_INCREMENT,
  `student_idstudent` INT NOT NULL,
  `class_idclass` INT NOT NULL,
  `date_joined` DATE NULL,
  PRIMARY KEY (`idenrolment`, `student_idstudent`, `class_idclass`),
  INDEX `fk_enrolment_student1_idx` (`student_idstudent` ASC),
  INDEX `fk_enrolment_class1_idx` (`class_idclass` ASC),
  CONSTRAINT `fk_enrolment_student1`
    FOREIGN KEY (`student_idstudent`)
    REFERENCES `tms`.`student` (`idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_enrolment_class1`
    FOREIGN KEY (`class_idclass`)
    REFERENCES `tms`.`class` (`idclass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`admin` (
  `idadmin` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NULL,
  `lname` VARCHAR(45) NULL,
  `nic` VARCHAR(45) NULL,
  `join_date` DATE NULL,
  PRIMARY KEY (`idadmin`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`student_payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`student_payment` (
  `idstudent_payment` INT NOT NULL AUTO_INCREMENT,
  `admin_idadmin` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`idstudent_payment`, `admin_idadmin`),
  INDEX `fk_invoice_admin1_idx` (`admin_idadmin` ASC),
  CONSTRAINT `fk_invoice_admin1`
    FOREIGN KEY (`admin_idadmin`)
    REFERENCES `tms`.`admin` (`idadmin`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`teacher_payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`teacher_payment` (
  `idteacher_payment` INT NOT NULL AUTO_INCREMENT,
  `admin_idadmin` INT NOT NULL,
  `issue_date` DATE NULL,
  `update_time` TIMESTAMP NULL,
  PRIMARY KEY (`idteacher_payment`, `admin_idadmin`),
  INDEX `fk_payment_admin1_idx` (`admin_idadmin` ASC),
  CONSTRAINT `fk_payment_admin1`
    FOREIGN KEY (`admin_idadmin`)
    REFERENCES `tms`.`admin` (`idadmin`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`hall`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`hall` (
  `idhall` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `note` VARCHAR(255) NULL,
  PRIMARY KEY (`idhall`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`timeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`timeslot` (
  `idtimeslot` INT NOT NULL AUTO_INCREMENT,
  `class_idclass` INT NOT NULL,
  `hall_idhall` INT NOT NULL,
  `weekday` TINYINT NULL,
  `duration` INT NULL,
  PRIMARY KEY (`idtimeslot`, `class_idclass`, `hall_idhall`),
  INDEX `fk_timeslot_class1_idx` (`class_idclass` ASC),
  INDEX `fk_timeslot_hall1_idx` (`hall_idhall` ASC),
  CONSTRAINT `fk_timeslot_class1`
    FOREIGN KEY (`class_idclass`)
    REFERENCES `tms`.`class` (`idclass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_timeslot_hall1`
    FOREIGN KEY (`hall_idhall`)
    REFERENCES `tms`.`hall` (`idhall`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`class_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`class_log` (
  `idclass_log` INT NOT NULL AUTO_INCREMENT,
  `class_idclass` INT NOT NULL,
  `timeslot_idtimeslot` INT NOT NULL,
  `date` DATE NULL,
  `is_payment_student` TINYINT NULL DEFAULT 0,
  `is_payment_teacher` TINYINT NULL DEFAULT 0,
  `teacher_payment_idteacher_payment` INT NOT NULL,
  PRIMARY KEY (`idclass_log`, `class_idclass`, `timeslot_idtimeslot`, `teacher_payment_idteacher_payment`),
  INDEX `fk_class_log_class1_idx` (`class_idclass` ASC),
  INDEX `fk_class_log_timeslot1_idx` (`timeslot_idtimeslot` ASC),
  INDEX `fk_class_log_teacher_payment1_idx` (`teacher_payment_idteacher_payment` ASC),
  CONSTRAINT `fk_class_log_class1`
    FOREIGN KEY (`class_idclass`)
    REFERENCES `tms`.`class` (`idclass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_log_timeslot1`
    FOREIGN KEY (`timeslot_idtimeslot`)
    REFERENCES `tms`.`timeslot` (`idtimeslot`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_log_teacher_payment1`
    FOREIGN KEY (`teacher_payment_idteacher_payment`)
    REFERENCES `tms`.`teacher_payment` (`idteacher_payment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`user` (
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `type` VARCHAR(1) NULL,
  `admin_idadmin` INT NOT NULL,
  `teacher_idteacher` INT NOT NULL,
  `student_idstudent` INT NOT NULL,
  PRIMARY KEY (`username`),
  INDEX `fk_user_admin1_idx` (`admin_idadmin` ASC),
  INDEX `fk_user_teacher1_idx` (`teacher_idteacher` ASC),
  INDEX `fk_user_student1_idx` (`student_idstudent` ASC),
  CONSTRAINT `fk_user_admin1`
    FOREIGN KEY (`admin_idadmin`)
    REFERENCES `tms`.`admin` (`idadmin`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_teacher1`
    FOREIGN KEY (`teacher_idteacher`)
    REFERENCES `tms`.`teacher` (`idteacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_student1`
    FOREIGN KEY (`student_idstudent`)
    REFERENCES `tms`.`student` (`idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `tms`.`exam`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`exam` (
  `idexam` INT NOT NULL,
  `name` VARCHAR(255) NULL,
  `date_time` DATETIME NULL,
  `duration` INT NULL,
  `class_idclass` INT NOT NULL,
  PRIMARY KEY (`idexam`, `class_idclass`),
  INDEX `fk_exam_class1_idx` (`class_idclass` ASC),
  CONSTRAINT `fk_exam_class1`
    FOREIGN KEY (`class_idclass`)
    REFERENCES `tms`.`class` (`idclass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`student_has_exam`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`student_has_exam` (
  `student_idstudent` INT NOT NULL,
  `exam_idexam` INT NOT NULL,
  `marks` INT(3) NULL,
  `notes` VARCHAR(255) NULL,
  PRIMARY KEY (`student_idstudent`, `exam_idexam`),
  INDEX `fk_student_has_exam_exam1_idx` (`exam_idexam` ASC),
  INDEX `fk_student_has_exam_student1_idx` (`student_idstudent` ASC),
  CONSTRAINT `fk_student_has_exam_student1`
    FOREIGN KEY (`student_idstudent`)
    REFERENCES `tms`.`student` (`idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_exam_exam1`
    FOREIGN KEY (`exam_idexam`)
    REFERENCES `tms`.`exam` (`idexam`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms`.`attendance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms`.`attendance` (
  `idattendance` INT NOT NULL AUTO_INCREMENT,
  `student_idstudent` INT NOT NULL,
  `class_log_idclass_log` INT NOT NULL,
  `state` TINYINT NULL DEFAULT 0,
  `student_payment_idstudent_payment` INT NOT NULL,
  PRIMARY KEY (`idattendance`, `student_idstudent`, `class_log_idclass_log`, `student_payment_idstudent_payment`),
  INDEX `fk_attendance_student1_idx` (`student_idstudent` ASC),
  INDEX `fk_attendance_class_log1_idx` (`class_log_idclass_log` ASC),
  INDEX `fk_attendance_student_payment1_idx` (`student_payment_idstudent_payment` ASC),
  CONSTRAINT `fk_attendance_student1`
    FOREIGN KEY (`student_idstudent`)
    REFERENCES `tms`.`student` (`idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attendance_class_log1`
    FOREIGN KEY (`class_log_idclass_log`)
    REFERENCES `tms`.`class_log` (`idclass_log`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attendance_student_payment1`
    FOREIGN KEY (`student_payment_idstudent_payment`)
    REFERENCES `tms`.`student_payment` (`idstudent_payment`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
