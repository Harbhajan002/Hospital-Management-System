create database hospital;
use hospital;
drop database hospital;
create table patient (
 patient_id int primary key AUTO_INCREMENT ,
 select_center varchar(100),
 fname varchar(50), 
 lname varchar(50),
 gender varchar(10), 
 mobile varchar(15) unique,
 email varchar(100),
 dob date,
 address varchar(100),
 state varchar(50),
 city varchar(50),
 pincode varchar(50),
 mr varchar(50) unique
 );
 SELECT * from patient where mr='HOS396101002';
drop table patient;
drop table appointment;
desc  patient;
select * from doctor;                                                                                                                                                                                                                            
create table doctor (
 doctor_id int(20) primary key AUTO_INCREMENT ,
 name varchar(50), 
 mobile varchar(15),
 email varchar(100),
 fees int,
 centre_id int,
 department_id int,
 slot_id json,
 foreign key (centre_id) references centre_name (centre_id),
  foreign key (department_id) references department (department_id)
 );
 ALTER TABLE doctor
MODIFY COLUMN email varchar(100);
 INSERT INTO doctor (name, mobile, email, fees, center_id, department_id, slot_id) VALUES
    ('Dr. Gaytri', '1234567890', 'drsmith@example.com', 100, 1, 1, '["1","2","3","4","6"]');

 INSERT INTO doctor (name, mobile, email, fees, center_id, department_id, slot_id) VALUES
    ('Dr. Smith', '1234567890', 'drsmith@example.com', 100, 1, 1, 1),
    ('Dr. Johnson', '9876543210', 'drjohnson@example.com', 150, 2, 2, 2),

       ('Dr. Jone', '345475940', 'drjone@example.com', 100, 4, 2, 5),
 ('Dr. John Doe', '123-456-7890', 'john.doe@example.com', 100, 1, 1, 1),
  ('Dr. Jane Smith', '987-654-3210', 'jane.smith@example.com', 120, 1, 2, 2),
  ('Dr. Michael Johnson', '555-555-5555', 'michael.johnson@example.com', 150, 2, 1, 3),
   ('Dr. Sarah Lee', '111-222-3333', 'sarah.lee@example.com', 130, 2, 2, 1),
    ('Dr. David Brown', '999-888-7777', 'david.brown@example.com', 110, 3, 3, 2),
    ('Dr. Sidhant', '123-456-7890', 'Sidhant.@example.com', 100, 1, 3, 6),
     ('Dr. Rahul Jain', '123-456-7890', 'rahul.jain@example.com', 100, 1, 4, 6);

INSERT INTO doctor (name, mobile, email, fees, centre_id, department_id, slot_id)
VALUES 
('Dr. Jatin kalra', '122-555-6000', 'Jatin.@example.com', 2000, 1, 5, '1,2,3,4,5,6'),
('Dr. Harsh kumar', '345-456-6000', 'Harsh.@example.com', 2000, 1, 2, '1,2,3,5,6'),
('Dr. Dhruv Rathee', '223-556-0890', 'Dhruv.rathee@example.com', 3000, 2, 3, '1,2,3,4,5,6'),
('Dr. Deeksha Jain', '444-556-0890', 'Deeksha.jain@example.com', 400, 4, 1, '1,2,3,4,5,6'),
    ('Dr. Gaytri', '1112223333', 'drgaytri@example.com', 1000, 3, 3, '1,2,3,4,5'),
     ('Dr. Vamsi', '234567899', 'drvamsi@example.com', 5000, 5, 4, '1,2,3,4,5,6');

drop table doctor;
select * from doctor;


truncate table patient;
 create table appointment(
 Appointment_id int primary key auto_increment,
 patient_id int, 
 slot_id int,
 doctor_id int,
 appoint_date date,
 appoint_time varchar(255),
  foreign key (patient_id) references patient (patient_id),
   foreign key (slot_id) references dateSlot (slot_id),
   foreign key (doctor_id) references doctor (doctor_id)
 );
  create table history_appointment(
 His_id int primary key auto_increment,
 patient_id int, 
 slot_id int,
 doctor_id int,
 appoint_date date,
 appoint_time varchar(255),
  foreign key (patient_id) references patient (patient_id),
   foreign key (slot_id) references dateSlot (slot_id),
   foreign key (doctor_id) references doctor (doctor_id)
 );
 
 desc appointment;
truncate table appointment;
select * from appointment;
SELECT name FROM department;

create table centre_name (
centre_id int primary key auto_increment, 
name varchar(50), 
address varchar(50), 
mobile varchar(15), 
email varchar(50),
logo blob
);
drop table center_name;
select * from centre_name;

insert into centre_name(name, address,mobile,email,logo) values
('AS Rao Nagar','123 Oak Street, usa',9145546778,'ankura1@gmail.com',load_file('path_to_your_image/logo.png')),
('Banjara Hills','456 Maple Lakeside city',34656566,'lakeside@yahoo.in',load_file('path_to_your_image/logo.png')),
('LB Nagar ','888 Magnolia Avenue, canada',234444444,'evergreen@gmail.com',load_file('path_to_your_image/logo.png')),
('Gachibowli','555 Cedar Gachibowli, New zealand',443454646,'sunset@gmail.com',load_file('path_to_your_image/logo.png')),
('Kompally','555 Cedar Kompally, New zealand',1234567890,'ankura@gmail.com',load_file('path_to_your_image/logo.png'));
SELECT * FROM doctor JOIN department ON doctor.department_id = department.department_id
  WHERE department.depart_name ='Pediatrician';

create table department (department_id int primary key auto_increment, depart_name varchar(50), centre_id int,
                         foreign key (centre_id) references centre_name (centre_id));
select* from department;
insert into department (depart_name, centre_id) values('Cardiologists', 1),('Psychiatrist', 2),
									 ('Pediatrician',3),('Neurologist',4),('Oncologist',5),
                                    ('Dermatologist',1),('Physicians',5);
SELECT *  FROM department WHERE centre_id = 1;
DELETE FROM department WHERE department_id = 3;
alter table slot change slot_date slot_date date;
alter table slot drop slot_date;

create table SlotOfWeek (
slot_id int primary key auto_increment, 
slot_Day VARCHAR(20) NOT NULL,
 time_id int,
   foreign key (time_id) references timeslot (time_id)
);
SELECT dateSlot.* FROM doctor
         JOIN dateSlot ON FIND_IN_SET(dateSlot.slot_id, doctor.slot_id) > 0
         WHERE doctor.doctor_id =1 and slot_Day ='Tuesday';
INSERT INTO SlotOfWeek (slot_Day, time_id) VALUES 
('Monday',1),
 ('Tuesday',2),
 ('Wednesday', 3),
('Thursday', 4),
('Friday',5),
 ('Saturday',6);		
 select * from SlotOfWeek ;
select * from SlotOfWeek where slot_id in 
(select slot_id from doctor where doctor_id='4') and time_id='3' ;
 
create table dateSlot (slot_id int primary key auto_increment, slot_Day VARCHAR(20) NOT NULL, slot_Time JSON);
INSERT INTO dateSlot (slot_Day, slot_Time) VALUES 
('Monday','["09:00 AM", "09:05 AM", "09:10 AM", "09:15 AM", "09:20 AM", "01:00 PM", "03:00"]'),
('Tuesday','["09:00 AM","10:00 AM","10:30 AM","11:00 AM","11:20 AM","04:00 PM", "08:00 PM"]'),
 ('Wednesday', '["09:00 AM","10:30 AM","11:30 AM","11:40 AM","12:20 PM", "05:00 PM"]'),
('Thursday', '["09:10 AM","09:40 AM","10:00 AM","11:30 AM","12:00 PM","01:00 PM"]'),
('Friday','["09:00 AM","10:00 AM","10:30 AM","11:00 AM","11:20 AM"]'),
 ('Saturday','["09:00 AM", "09:05 AM", "09:10 AM", "09:15 AM", "09:20 AM", "10:00 AM",
                  "11:00 AM", "04:00 PM", "05:00 PM"]'),
('Saturday','["09:00 AM", "09:05 AM", "09:10 AM", "09:15 AM", "09:20 AM", "10:00 AM",
                  "11:00 AM", "04:00 PM", "05:00 PM"]');
-- Step 1: Create a new table
SELECT dateSlot.*
FROM doctor
JOIN dateSlot ON FIND_IN_SET(dateSlot.slot_id, doctor.slot_id) > 0
WHERE doctor.doctor_id = 3 ;
select * from dateSlot;
select * from doctor where doctor_id =7;
SELECT *
FROM doctor
WHERE doctor_id = 7
AND FIND_IN_SET('1', REPLACE(REPLACE(slot_id, '["', ''), '"]', ''));
;


select * from dateslot where slot_id=1;
drop table other_table;
select * from SlotOfWeek;

select * from dateSlot ;
select * from dateSlot where slot_id in 
(select slot_id from doctor where doctor_id='4') and slot_Day='Tuesday' ; 

DELETE FROM slot
WHERE slot_id BETWEEN 10 AND 49;
truncate table slot;
create table otp (
otp_id int primary key auto_increment, 
mobile varchar(15) not null, 
patient_id int,
curr_time time,
expire_time time,
otp_code int(10),
 foreign key (patient_id) references patient (patient_id)
 );

create table doctor_slot_availablity (availablity_id int primary key auto_increment, 
slot_id int, doctor_id int,sl_date date, avilable_slot JSON);

drop table doctor_slot_availablity;
create table unBookeddataslot(
 id int primary key auto_increment,
 slot_id int, 
 doctor_id int,
 slot_date date, 
 unBook_slot json
 );
 select * from timeslot;
 select * from center_name;
 select * from appointment;
 select * from history_appointment;
 truncate table unBookeddataslot;
 select * from doctor_slot_availablity; 
  select * from dateslot; 
  select*from unBookeddataslot;
DELETE from appointment where patient_id=1 and doctor_id=3 and
appoint_time='11:30 AM';
  UPDATE unBookeddataslot set 
  unBook_slot='["10:00 AM", "11:30 AM", "12:00 PM", "01:00 PM"]'
                          where slot_date ='2024-03-28 'and doctor_id=1;
 select * from otp;
 select * from doctor;
 select * from patient;
 SELECT * from unBookeddataslot where doctor_id = 4 and slot_date = '2024-03-22';
 select depart_name from department where department_id in (select department_id from doctor where doctor_id ='1');
UPDATE doctor_slot_availablity set  avilable_slot='["10:00 AM","11:30 AM","12:00 PM"]'
                  where doctor_id = 1 and sl_date = '2024-03-28';
select * from department ;
 truncate otp;
 desc otp;
 alter table otp add column otp_code int(10);
 drop table otp;
 -- select * from admin;
-- SELECT * from appointment;
-- select * from centre_name;
-- select * from dateslot;
-- select * from department;
-- select * from doctor;
-- select * from doctor_slot_availablity;
-- select * from otp;
-- select * from patient;
-- select * from unbookeddataslot;


-- SELECT * FROM doctor JOIN department ON doctor.department_id = department.department_id WHERE department.depart_name ='Pediatrician';

-- create table SlotOfWeek (
-- slot_id int primary key auto_increment, 
-- slot_Day VARCHAR(20) NOT NULL,
-- time_id int,
-- foreign key (time_id) references timeslot (time_id)
-- );
-- select * from SlotOfWeek;

-- INSERT INTO SlotOfWeek (slot_Day, time_id) VALUES 
-- ('Monday',1),
--  ('Tuesday',2),
--  ('Wednesday', 3),
-- ('Thursday', 4),
-- ('Friday',5),
--  ('Saturday',6);