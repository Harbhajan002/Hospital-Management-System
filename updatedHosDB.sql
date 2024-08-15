create database hospital;
use hospital;
create table admin (
admin_id int(20) primary key AUTO_INCREMENT ,
name varchar(50), 
mobile varchar(15),
email varchar(100),
password varchar(100)
);
INSERT INTO admin (name, mobile, email, password)
VALUES ('Admin', '8816839205', 'adminhost@gmail.com', 'admin');

create table appointment(
Appointment_id int primary key auto_increment,
patient_id int, 
slot_id int,
doctor_id int,
appoint_date date,
appoint_time varchar(255),
status varchar(255) default "Pending",
foreign key (patient_id) references patient (patient_id),
foreign key (slot_id) references dateSlot (slot_id),
foreign key (doctor_id) references doctor (doctor_id)
);



create table centre_name (
centre_id int primary key auto_increment, 
name varchar(50), 
address varchar(50), 
mobile varchar(15), 
email varchar(50),
logo blob
);

insert into centre_name(name, address,mobile,email,logo) values
('AS Rao Nagar','123 Oak Street, usa',9145546778,'ankura1@gmail.com',load_file('path_to_your_image/logo.png')),
('Banjara Hills','456 Maple Lakeside city',34656566,'lakeside@yahoo.in',load_file('path_to_your_image/logo.png')),
('LB Nagar ','888 Magnolia Avenue, canada',234444444,'evergreen@gmail.com',load_file('path_to_your_image/logo.png')),
('Gachibowli','555 Cedar Gachibowli, New zealand',443454646,'sunset@gmail.com',load_file('path_to_your_image/logo.png')),
('Kompally','555 Cedar Kompally, New zealand',1234567890,'ankura@gmail.com',load_file('path_to_your_image/logo.png'));

create table dateslot (
slot_id int primary key auto_increment, 
slot_Day VARCHAR(20) NOT NULL, 
slot_Time JSON);

INSERT INTO dateslot (slot_Day, slot_Time) VALUES 
('Monday','["09:00 AM", "09:05 AM", "09:10 AM", "09:15 AM", "09:20 AM", "01:00 PM", "03:00"]'),
('Tuesday','["09:00 AM","10:00 AM","10:30 AM","11:00 AM","11:20 AM","04:00 PM", "08:00 PM"]'),
('Wednesday', '["09:00 AM","10:30 AM","11:30 PM","11:40 AM","12:20 PM", "05:00 PM"]'),
('Thursday', '["09:10 AM","09:40 AM","10:00 AM","11:30 AM","12:00 PM","01:00 PM"]'),
('Friday','["09:00 AM","10:00 AM","10:30 AM","11:00 AM","11:20 AM","1:20 AM","2:20 AM","5:00 PM"]'),
('Saturday','["09:00 AM", "09:05 PM", "09:10 AM", "09:15 AM", "09:20 AM", "10:00 AM", "11:00 AM", "04:00 PM", "05:00 PM"]'),
('Sunday','["09:00 AM", "09:05 AM", "09:10 PM", "09:15 AM", "09:20 AM", "10:00 AM", "11:00 AM", "04:00 PM", "05:00 PM"]');

create table department (
department_id int primary key auto_increment, 
depart_name varchar(50), 
centre_id int,
foreign key (centre_id) references centre_name (centre_id));

insert into department (depart_name, centre_id) values
('Cardiologists', 1),('General Surgery', 1),('Psychiatrist', 2),('Endocrinology', 2),('Pediatrician',3),
('Emergency',3),('Neurologist',4),('Anesthesiology',4),('Oncologist',5),('Dermatologist',1),('Physicians',5);

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

create table doctor_slot_availablity (
availablity_id int primary key auto_increment, 
slot_id int, 
doctor_id int,
sl_date date, 
avilable_slot JSON);

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

create table otp (
otp_id int primary key auto_increment, 
mobile varchar(15) not null, 
patient_id int,
curr_time time,
expire_time time,
otp_code int(10),
 foreign key (patient_id) references patient (patient_id)
 );
 
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
 select * from patient;
 
 create table unBookeddataslot(
 id int primary key auto_increment,
 slot_id int, 
 doctor_id int,
 slot_date date, 
 unBook_slot json
 );
 

		











 
 