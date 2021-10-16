CREATE TABLE Infection(
caseId INT AUTO_INCREMENT,
dateOfInfection DATE,
PRIMARY KEY(caseId)
);
 
CREATE TABLE Covid(
type VARCHAR(255),
PRIMARY KEY(type)
);
 
CREATE TABLE Infection_type(
type VARCHAR(255),
caseId INT UNIQUE,
FOREIGN KEY(type) REFERENCES Covid(type)
);
 
CREATE TABLE Person_info(
SSN_Passport VARCHAR(255),
birthday DATE,
citizenship VARCHAR(255),
email VARCHAR(255),
lastName VARCHAR(255),
firstName VARCHAR(255),
postalCode VARCHAR(255),
address VARCHAR(255),
province VARCHAR(255),
city VARCHAR(255),
PRIMARY KEY(SSN_Passport)
);
 
CREATE TABLE Medicare(
medicare VARCHAR(255),
telephone VARCHAR(255),
SSN_Passport VARCHAR(255),
PRIMARY KEY(telephone)
);
 
CREATE TABLE Vaccination_Faculty(
address VARCHAR(255),
name VARCHAR(255),
webAddress VARCHAR(255),
type VARCHAR(255),
phone VARCHAR(255),
province VARCHAR(255),
city VARCHAR(255),
PRIMARY KEY(address, city, province)
);
 
CREATE TABLE Priority_Groups(
id INT,
ageMin INT,
ageMAx INT,
PRIMARY KEY(id)
);
 
CREATE TABLE Vaccines(
name VARCHAR(255),
dateOfApproval DATE,
type VARCHAR(255) DEFAULT 'UNKNOWN',
dateOfSuspension DATE,
PRIMARY KEY(name)
);
 
CREATE TABLE Vaccination(
doseNumber INT,
date DATE,
SSN_Passport VARCHAR(255),
typeOfVaccine VARCHAR(255),
name VARCHAR(255),
address VARCHAR(255),
province VARCHAR(255),
city VARCHAR(255),
EID INT,
FOREIGN KEY(EID) REFERENCES Public_Health_Worker_Info(EID),
FOREIGN KEY(name) REFERENCES Vaccines(name),
FOREIGN KEY(address, city, province) REFERENCES Vaccination_Faculty(address, city, province),
FOREIGN KEY(SSN_Passport) REFERENCES Person_info(SSN_Passport)
);
 
CREATE TABLE GroupAge(
SSN_Passport VARCHAR(255) UNIQUE,
groupNumber INT,
FOREIGN KEY(SSN_Passport) REFERENCES Person_info(SSN_Passport)
);
 
CREATE TABLE Infected(
infectionCaseId INT UNIQUE,
SSN_Passport VARCHAR(255),
FOREIGN KEY(infectionCaseId) REFERENCES Infection(caseId)
);
 
CREATE TABLE Inventory(
address VARCHAR(255),
city VARCHAR(255),
province VARCHAR(255),
name VARCHAR(255),
numOfVaccines INT DEFAULT 0,
FOREIGN KEY(address, city, province) REFERENCES Vaccination_Faculty(address, city, province),
FOREIGN KEY(name) REFERENCES Vaccines(name)
);
 
CREATE TABLE Shipment(
address VARCHAR(255),
city VARCHAR(255),
province VARCHAR(255),
name VARCHAR(255),
dateOfReception DATE,
count INT,
FOREIGN KEY(address, city, province) REFERENCES Vaccination_Faculty(address, city, province),
FOREIGN KEY(name) REFERENCES Vaccines(name)
);
 
CREATE TABLE Transfer(
initialAddress VARCHAR(255),
initialCity VARCHAR(255),
initialProvince VARCHAR(255),
finalAddress VARCHAR(255),
finalCity VARCHAR(255),
finalProvince VARCHAR(255),
name VARCHAR(255),
date DATE,
count INT,
FOREIGN KEY(initialAddress, initialCity, initialProvince) REFERENCES Vaccination_Faculty(address, city, province),
FOREIGN KEY(finalAddress, finalCity, finalProvince) REFERENCES Vaccination_Faculty(address, city, province),
FOREIGN KEY(name) REFERENCES Vaccines(name)
);
 
CREATE TABLE Public_Health_Worker_Id(
SSN_Passport VARCHAR(255),
telephone VARCHAR(255),
EID INT,
medicare VARCHAR(255),
PRIMARY KEY(telephone)
);
 
CREATE TABLE Public_Health_Worker_Info(
EID INT,
birthday DATE,
citizenship VARCHAR(255),
email VARCHAR(255),
lastName VARCHAR(255),
firstName VARCHAR(255),
postalCode VARCHAR(255),
address VARCHAR(255),
province VARCHAR(255),
city VARCHAR(255),
PRIMARY KEY(EID)
);
 
CREATE TABLE Work_record(
EID INT,
address VARCHAR(255),
city VARCHAR(255),
province VARCHAR(255),
startDate DATE,
endDate DATE,
FOREIGN KEY(EID) REFERENCES Public_Health_Worker_Info(EID),
FOREIGN KEY(address, city, province) REFERENCES Vaccination_Faculty(address, city, province)
);
 
CREATE TABLE Management_record(
EID INT UNIQUE,
UNIQUE KEY address(address, city, province),
address VARCHAR(255),
city VARCHAR(255),
province VARCHAR(255),
startDate DATE,
endDate DATE,
FOREIGN KEY(EID) REFERENCES Public_Health_Worker_Info(EID)
);
 
CREATE TABLE Province_priority(
provincialCode VARCHAR(255),
PRIMARY KEY(provincialCode)
);
 
CREATE TABLE Provincial_priority(
provincialCode VARCHAR(255),
groupId INT,
isPrioritized VARCHAR(255),
FOREIGN KEY(provincialCode) REFERENCES Province_priority(provincialCode),
FOREIGN KEY(groupId) REFERENCES Priority_Groups(id)
);

SELECT Person_info.firstName, Person_info.lastName, Person_info.birthday, Person_info.email, Medicare.telephone, Person_info.city 
                            FROM Person_info,Medicare
                            WHERE Person_info.SSN_Passport = Medicare.SSN_Passport;

SELECT Person_info.firstName, Person_info.lastName, Person_info.birthday, Person_info.email, Medicare.telephone, Person_info.city 
                        from Person_info,Medicare
                        where Medicare.SSN_Passport = Person_info.SSN_Passport = :SSN_Passport;

DELETE FROM Person_info WHERE SSN_Passport = :SSN_Passport;
DELETE FROM Medicare WHERE SSN_Passport = :SSN_Passport;

DELETE FROM Infection WHERE caseId = :caseId;
DELETE FROM Infected WHERE SSN_Passport = :SSN_Passport;

INSERT INTO Person_info (SSN_Passport,birthday,citizenship,email,lastName,firstName,postalCode,address,province,city)
                            VALUES(:SSN_Passport,:birthday,:citizenship,:email,:lastName,:firstName,:postalCode,:address,:province,:city);

INSERT INTO Public_Health_Worker_info (EID,birthday,citizenship,email,lastName,firstName,postalCode,address,province,city)
                            VALUES(:EID,:birthday,:citizenship,:email,:lastName,:firstName,:postalCode,:address,:province,:city);

DELETE FROM Public_Health_Worker_Info WHERE EID = :EID;
DELETE FROM Public_Health_Worker_Id WHERE EID = :EID;

SELECT Public_Health_Worker_Info.firstName, Public_Health_Worker_Info.lastName, Public_Health_Worker_Info.email, Public_Health_Worker_Info.city 
                        from Public_Health_Worker_Info
                        where Public_Health_Worker_Info = :EID;

SELECT Public_Health_Worker_info.firstName, Public_Health_Worker_info.lastName, Public_Health_Worker_info.birthday, Public_Health_Worker_info.email, Public_Health_Worker_Id.telephone, Public_Health_Worker_info.city 
                            FROM Public_Health_Worker_info,Public_Health_Worker_Id
                            WHERE Public_Health_Worker_info.EID = Public_Health_Worker_Id.EID;

UPDATE Vaccination_Faculty SET 
    address = :address,
    name = :name,
    webAddress = :webAddress,
    type = :type,
    phone = :phone,
    province = :province,
    city = :city
    WHERE address = :address AND province = :province AND city = :city;

Show:
SELECT v.address, v.name, v.webAddress, v.type, v.phone, v.province, v.city
    FROM Vaccination_Faculty as v;

Delete:
DELETE FROM Vaccination_Faculty WHERE address = :address AND province = :province AND city = :city;

Create:
INSERT INTO Vaccination_Faculty (address,name,webAddress,type,phone,province,city)
    VALUES(:address,:name,:webAddress,:type,:phone,:province,:city);



#4
SELECT Vaccines.name, Vaccines.dateOfApproval, Vaccines.type, Vaccines.dateOfSuspension
                            FROM Vaccines;

UPDATE Vaccines SET 
                            name = :name,
                            dateOfApproval = :dateOfApproval,
                            type = :type,
                            dateOfSuspension = :dateOfSuspension,
                            WHERE name = :name;

DELETE FROM Vaccines WHERE name = :name;


#5
SELECT * FROM Covid;
INSERT INTO Covid (type) VALUES(:type);
DELETE FROM Covid WHERE type = :type;
UPDATE Covid SET type = :newType WHERE type = :type;

#6
Show:
SELECT g.id, g.ageMin, g.ageMAx
                            FROM Priority_Groups as g;
Edit:
UPDATE Priority_Groups SET 
                            ageMin = :ageMin,
                            ageMAx = :ageMAx
                            WHERE id = :id;
Delete:
DELETE FROM Priority_Groups WHERE id = :id;
Create:

INSERT INTO Priority_Groups (id,ageMin,ageMAx)
                            VALUES(:id,:ageMin,:ageMAx);

#7
INSERT INTO qkc353_1.Province_priority (provincialCode)
                            VALUES(:provincialCode);
DELETE FROM qkc353_1.Provincial_priority WHERE provincialCode = :provincialCode;
DELETE FROM qkc353_1.Province_priority WHERE provincialCode = :provincialCode;
UPDATE qkc353_1.Provincial_priority SET 
                            provincialCode = :provincialCode
                            WHERE provincialCode = :provincialCode;
UPDATE qkc353_1.Province_priority SET 
                                provincialCode = :provincialCode
                                WHERE provincialCode = :provincialCode;
SELECT * FROM Province_priority;

#8
INSERT INTO qkc353_1.Provincial_priority (provincialCode, groupId, isPrioritized)
                            VALUES(:provincialCode,:groupId,:isPrioritized);

#9
INSERT INTO Shipment (address,city,province,name,dateOfReception,count)
                            VALUES(:address,:city,:province,:name,:dateOfReception,:numOfVaccines);
                          UPDATE Inventory SET numOfVaccines = numOfVaccines + :numOfVaccines WHERE Inventory.address = :address AND Inventory.province = :province AND Inventory.city = :city AND Inventory.name = :name;


#10
INSERT INTO Transfer VALUES('4513 Saint-Tabernak street','Kinston','ON','1084 Fourrier street','Montreal','QC','Moderna','2021-06-06',25);
UPDATE Inventory
SET
    numOfVaccines = numOfVaccines - 25
WHERE
    address = '4513 Saint-Tabernak street' AND name = 'Moderna';
UPDATE Inventory
SET 
    numOfVaccines = numOfVaccines + 25
WHERE
    address = '1084 Fourrier street' AND name = 'Moderna';

#11
SELECT v.SSN_Passport, p.firstName, p.lastName, v.name ,v.date, v.doseNumber , v.EID
FROM Vaccination as v, Person_info as p
WHERE v.SSN_Passport=p.SSN_Passport;

#12
SELECT distinct firstName, Person_info.lastName, Person_info.birthday, Person_info.email, Medicare.telephone, Person_info.city, Vaccination.date, Vaccination.typeOfVaccine
FROM Person_info, Medicare, Vaccination, Infection, GroupAge , Infected 
WHERE Person_info.SSN_Passport = Medicare.SSN_Passport AND Person_info.SSN_Passport = GroupAge.SSN_Passport AND Person_info.SSN_Passport = Vaccination.SSN_Passport AND GroupAge.groupNumber >= 1 AND GroupAge.groupNumber <= 3 
AND Vaccination.doseNumber = 1;



#13
SELECT Person_info.firstName, Person_info.lastName, Person_info.birthday, Person_info.email, Medicare.telephone, Person_info.city, Vaccination.date, Vaccines.type, Infection.dateOfInfection 
FROM Person_info, Medicare, Vaccination, Infected, Infection , Vaccines 
WHERE (Person_info.SSN_Passport = Medicare.SSN_Passport = Vaccination.SSN_Passport = Infected.SSN_Passport 
OR Person_info.SSN_Passport = Medicare.SSN_Passport = Vaccination.SSN_Passport) AND Person_info.city = "Montreal"
AND EXISTS(SELECT COUNT(DISTINCT(Vaccination.name)) FROM Vaccination where Vaccination.SSN_Passport = Vaccination.SSN_Passport HAVING count(*) > 1)
HAVING count(Vaccination.SSN_Passport) > 1;



#14
select result.firstName, result.lastName, result.birthday, result.email, result.telephone, result.city, result.date, result.typeOfVaccine, group_concat(variants)
FROM (
SELECT Person_info.firstName,  Person_info.lastName, Person_info.birthday, Person_info.email, Medicare.telephone, Person_info.city, Vaccination.date, Vaccination.typeOfVaccine, group_concat(Distinct Infection_type.type) as variants, count(Infection_type.type)
FROM Person_info, Medicare, Vaccination, Infected, Infection, Infection_type
WHERE Person_info.SSN_Passport = Medicare.SSN_Passport and Person_info.SSN_Passport = Vaccination.SSN_Passport and Person_info.SSN_Passport = Infected.SSN_Passport
and Infected.infectionCaseId = Infection_type.caseId  
group by Person_info.SSN_Passport, Infection_type.type
) as result
group by result.email
having count(*)>1;



#15
SELECT i.province, v.type , v.name, SUM(i.numOfVaccines) AS sum 
FROM Inventory as i, Vaccines as v 
WHERE i.name = v.name 
GROUP BY i.province, v.name 
ORDER BY i.province ASC, SUM(i.numOfVaccines) DESC;



#16
SELECT a.province, a.name, COUNT(*) as sum
                            FROM (
                            	SELECT v.province, v.name, v.SSN_Passport From Vaccination as v 
                            	WHERE v.date >= "2021-01-01" AND v.date <= "2021-07-22"
                            	GROUP BY v.province, v.name, v.SSN_Passport
                                ) as a
                              GROUP BY a.province, a.name;

#17
SELECT v.city,SUM(DISTINCT v.SSN_Passport) as sum
FROM Vaccination as v 
WHERE v.province ="QC" AND v.date > "2020-12-31" AND v.date < "2021-07-23" 
GROUP BY v.city;


#18
Select vacWorker.name, vacWorker.address, vacWorker.type, vacWorker.phone, vacWorker.NbrWorker, count(*) as NbrShipm 
from(
SELECT vf.name,vf.address,vf.type,vf.phone, count(*) as NbrWorker
FROM Vaccination_Faculty as vf, Work_record as wr
WHERE vf.city = 'Montreal'and vf.city = wr.city and vf.address = wr.address and vf.province = wr.province
group by vf.province, vf.address, vf.city
) as vacWorker, Shipment as sh
where vacWorker.address = sh.address;



#19
SELECT pi.EID, pi.birthday, pi.citizenship, pi.email, pi.firstName, pi.lastName , pi.postalCode, pi.address, pi.province, pi.city,pw.SSN_Passport, pw.telephone, pw.medicare, w.startDate,w.endDate 
FROM Public_Health_Worker_Id as pw,Public_Health_Worker_Info as pi, Vaccination_Faculty as v, Work_record as w 
WHERE pw.EID=pi.EID AND v.name =:name AND w.EID = pw.EID AND v.address = w.address AND v.city = w.city AND v.province = w.province;

#20
SELECT pw.EID,pw.firstName,pw.lastName,pw.birthday,pi.telephone,pw.city,pw.email
FROM Public_Health_Worker_Info as pw,Public_Health_Worker_Id as pi, Vaccination v
WHERE (pw.EID = pi.EID AND NOT(v.SSN_Passport = pi.SSN_Passport)) or 
(pw.EID = pi.EID AND v.SSN_Passport = pi.SSN_Passport AND doseNumber<2)
group by EID;

