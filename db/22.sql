-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tms_00
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tms_00
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tms_00` DEFAULT CHARACTER SET utf8 ;
USE `tms_00` ;

-- -----------------------------------------------------
-- Table `tms_00`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`student` (
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
-- Table `tms_00`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`user` (
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `type` VARCHAR(1) NULL,
  PRIMARY KEY (`username`));


-- -----------------------------------------------------
-- Table `tms_00`.`teacher`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`teacher` (
  `idteacher` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NULL,
  `lname` VARCHAR(45) NULL,
  `nic` VARCHAR(45) NULL,
  `join_date` DATE NULL,
  `user_username` VARCHAR(16) NOT NULL,
  PRIMARY KEY (`idteacher`, `user_username`),
  INDEX `fk_teacher_user1_idx` (`user_username` ASC),
  CONSTRAINT `fk_teacher_user1`
    FOREIGN KEY (`user_username`)
    REFERENCES `tms_00`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`subject` (
  `idsubject` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `grade` VARCHAR(45) NULL,
  `syllabus_year` YEAR NULL,
  `medium` VARCHAR(45) NULL,
  PRIMARY KEY (`idsubject`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`class` (
  `idclass` INT NOT NULL AUTO_INCREMENT,
  `teacher_idteacher` INT NOT NULL,
  `subject_idsubject` INT NOT NULL,
  `hourly_rate` INT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`idclass`, `teacher_idteacher`, `subject_idsubject`),
  INDEX `fk_class_teacher1_idx` (`teacher_idteacher` ASC),
  INDEX `fk_class_subject1_idx` (`subject_idsubject` ASC),
  CONSTRAINT `fk_class_teacher1`
    FOREIGN KEY (`teacher_idteacher`)
    REFERENCES `tms_00`.`teacher` (`idteacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_subject1`
    FOREIGN KEY (`subject_idsubject`)
    REFERENCES `tms_00`.`subject` (`idsubject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`enrolment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`enrolment` (
  `student_idstudent` INT NOT NULL,
  `class_idclass` INT NOT NULL,
  `date_joined` DATE NULL,
  PRIMARY KEY (`student_idstudent`, `class_idclass`),
  INDEX `fk_enrolment_student1_idx` (`student_idstudent` ASC),
  INDEX `fk_enrolment_class1_idx` (`class_idclass` ASC),
  CONSTRAINT `fk_enrolment_student1`
    FOREIGN KEY (`student_idstudent`)
    REFERENCES `tms_00`.`student` (`idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_enrolment_class1`
    FOREIGN KEY (`class_idclass`)
    REFERENCES `tms_00`.`class` (`idclass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`hall`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`hall` (
  `idhall` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `note` VARCHAR(255) NULL,
  PRIMARY KEY (`idhall`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`timeslot`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`timeslot` (
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
    REFERENCES `tms_00`.`class` (`idclass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_timeslot_hall1`
    FOREIGN KEY (`hall_idhall`)
    REFERENCES `tms_00`.`hall` (`idhall`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`class_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`class_log` (
  `idclass_log` INT NOT NULL AUTO_INCREMENT,
  `class_idclass` INT NOT NULL,
  `timeslot_idtimeslot` INT NOT NULL,
  `date` DATE NULL,
  PRIMARY KEY (`idclass_log`, `class_idclass`, `timeslot_idtimeslot`),
  INDEX `fk_class_log_class1_idx` (`class_idclass` ASC),
  INDEX `fk_class_log_timeslot1_idx` (`timeslot_idtimeslot` ASC),
  CONSTRAINT `fk_class_log_class1`
    FOREIGN KEY (`class_idclass`)
    REFERENCES `tms_00`.`class` (`idclass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_log_timeslot1`
    FOREIGN KEY (`timeslot_idtimeslot`)
    REFERENCES `tms_00`.`timeslot` (`idtimeslot`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`admin` (
  `idadmin` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NULL,
  `lname` VARCHAR(45) NULL,
  `nic` VARCHAR(45) NULL,
  `join_date` DATE NULL,
  `user_username` VARCHAR(16) NOT NULL,
  PRIMARY KEY (`idadmin`, `user_username`),
  INDEX `fk_admin_user1_idx` (`user_username` ASC),
  CONSTRAINT `fk_admin_user1`
    FOREIGN KEY (`user_username`)
    REFERENCES `tms_00`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`invoice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`invoice` (
  `idinvoice` INT NOT NULL AUTO_INCREMENT,
  `class_log_idclass_log` INT NOT NULL,
  `student_idstudent` INT NOT NULL,
  `admin_idadmin` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`idinvoice`, `class_log_idclass_log`, `student_idstudent`, `admin_idadmin`),
  INDEX `fk_invoice_class_log1_idx` (`class_log_idclass_log` ASC),
  INDEX `fk_invoice_student1_idx` (`student_idstudent` ASC),
  INDEX `fk_invoice_admin1_idx` (`admin_idadmin` ASC),
  CONSTRAINT `fk_invoice_class_log1`
    FOREIGN KEY (`class_log_idclass_log`)
    REFERENCES `tms_00`.`class_log` (`idclass_log`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_student1`
    FOREIGN KEY (`student_idstudent`)
    REFERENCES `tms_00`.`student` (`idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_admin1`
    FOREIGN KEY (`admin_idadmin`)
    REFERENCES `tms_00`.`admin` (`idadmin`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`exam`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`exam` (
  `idexam` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `duration` INT NULL,
  PRIMARY KEY (`idexam`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`payment` (
  `idpayment` INT NOT NULL AUTO_INCREMENT,
  `admin_idadmin` INT NOT NULL,
  `teacher_idteacher` INT NOT NULL,
  `issue_date` DATE NULL,
  `update_time` TIMESTAMP NULL,
  PRIMARY KEY (`idpayment`, `admin_idadmin`, `teacher_idteacher`),
  INDEX `fk_payment_admin1_idx` (`admin_idadmin` ASC),
  INDEX `fk_payment_teacher1_idx` (`teacher_idteacher` ASC),
  CONSTRAINT `fk_payment_admin1`
    FOREIGN KEY (`admin_idadmin`)
    REFERENCES `tms_00`.`admin` (`idadmin`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_payment_teacher1`
    FOREIGN KEY (`teacher_idteacher`)
    REFERENCES `tms_00`.`teacher` (`idteacher`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`subject_has_exam`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`subject_has_exam` (
  `subject_idsubject` INT NOT NULL,
  `exam_idexam` INT NOT NULL,
  PRIMARY KEY (`subject_idsubject`, `exam_idexam`),
  INDEX `fk_subject_has_exam_exam1_idx` (`exam_idexam` ASC),
  INDEX `fk_subject_has_exam_subject1_idx` (`subject_idsubject` ASC),
  CONSTRAINT `fk_subject_has_exam_subject1`
    FOREIGN KEY (`subject_idsubject`)
    REFERENCES `tms_00`.`subject` (`idsubject`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_subject_has_exam_exam1`
    FOREIGN KEY (`exam_idexam`)
    REFERENCES `tms_00`.`exam` (`idexam`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`exam_has_class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`exam_has_class` (
  `exam_idexam` INT NOT NULL,
  `class_idclass` INT NOT NULL,
  `date_time` DATETIME NULL,
  PRIMARY KEY (`exam_idexam`, `class_idclass`),
  INDEX `fk_exam_has_class_class1_idx` (`class_idclass` ASC),
  INDEX `fk_exam_has_class_exam1_idx` (`exam_idexam` ASC),
  CONSTRAINT `fk_exam_has_class_exam1`
    FOREIGN KEY (`exam_idexam`)
    REFERENCES `tms_00`.`exam` (`idexam`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_exam_has_class_class1`
    FOREIGN KEY (`class_idclass`)
    REFERENCES `tms_00`.`class` (`idclass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`attendance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`attendance` (
  `class_log_idclass_log` INT NOT NULL,
  `enrolment_student_idstudent` INT NOT NULL,
  `is_attended` TINYINT NULL,
  PRIMARY KEY (`class_log_idclass_log`, `enrolment_student_idstudent`),
  INDEX `fk_attendance_enrolment1_idx` (`enrolment_student_idstudent` ASC),
  CONSTRAINT `fk_attendance_class_log1`
    FOREIGN KEY (`class_log_idclass_log`)
    REFERENCES `tms_00`.`class_log` (`idclass_log`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_attendance_enrolment1`
    FOREIGN KEY (`enrolment_student_idstudent`)
    REFERENCES `tms_00`.`enrolment` (`student_idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`teacher_has_exam`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`teacher_has_exam` (
  `teacher_user_username` VARCHAR(16) NOT NULL,
  `exam_idexam` INT NOT NULL,
  PRIMARY KEY (`teacher_user_username`, `exam_idexam`),
  INDEX `fk_teacher_has_exam_exam1_idx` (`exam_idexam` ASC),
  CONSTRAINT `fk_teacher_has_exam_exam1`
    FOREIGN KEY (`exam_idexam`)
    REFERENCES `tms_00`.`exam` (`idexam`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tms_00`.`student_has_exam_has_class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tms_00`.`student_has_exam_has_class` (
  `student_idstudent` INT NOT NULL,
  `exam_has_class_exam_idexam` INT NOT NULL,
  `exam_has_class_class_idclass` INT NOT NULL,
  PRIMARY KEY (`student_idstudent`, `exam_has_class_exam_idexam`, `exam_has_class_class_idclass`),
  INDEX `fk_student_has_exam_has_class_exam_has_class1_idx` (`exam_has_class_exam_idexam` ASC, `exam_has_class_class_idclass` ASC),
  INDEX `fk_student_has_exam_has_class_student1_idx` (`student_idstudent` ASC),
  CONSTRAINT `fk_student_has_exam_has_class_student1`
    FOREIGN KEY (`student_idstudent`)
    REFERENCES `tms_00`.`student` (`idstudent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_has_exam_has_class_exam_has_class1`
    FOREIGN KEY (`exam_has_class_exam_idexam` , `exam_has_class_class_idclass`)
    REFERENCES `tms_00`.`exam_has_class` (`exam_idexam` , `class_idclass`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
