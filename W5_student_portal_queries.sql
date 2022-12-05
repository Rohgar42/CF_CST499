CREATE DATABASE studentportal;

USE studentportal;

CREATE USER 'test_tester'@'localhost' IDENTIFIED BY 'password1';
GRANT DELETE, INSERT, UPDATE, SELECT ON studentportal.* TO 'test_tester'@'localhost';

CREATE TABLE `tblavailablecourses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courseId` int(11) NOT NULL,
  `termId` int(11) NOT NULL,
  `yearId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tblcourse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courseName` varchar(100) NOT NULL,
  `courseDesc` longtext NOT NULL,
  `courseNomenclature` varchar(8) NOT NULL,
  `courseMinSize` int(11) NOT NULL,
  `courseMaxSize` int(11) NOT NULL,
  `credits` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tblenrolled` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `termId` int(11) NOT NULL,
  `yearId` int(11) NOT NULL,
  `enrollDate` date NOT NULL DEFAULT curdate(),
  PRIMARY KEY (`id`)
);


CREATE TABLE `tblterm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `streetAddr` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `homephone` varchar(20) DEFAULT NULL,
  `cellphone` varchar(20) DEFAULT NULL,
  `ssn` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Student, 1 = Admin',
  `notifyFlag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tblwaitlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `availCourseId` int(11) NOT NULL,
  `termId` int(11) NOT NULL,
  `yearId` int(11) NOT NULL,
  `waitlistDate` timestamp	 NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);

CREATE TABLE `tblyear` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

USE studentportal;

INSERT INTO tblcourse (courseName, courseDesc, courseNomenclature, courseMinSize, courseMaxSize, credits)
  VALUES ('Statistical Literacy', 'This course is designed to meet general education quantitative reasoning (mathematics) requirements. It will cover such topics as sampling, bias, probability, distributions, graphical methods of portraying data, measures of center, dispersion, and position, and the Central Limit Theorem. It will also cover computational techniques such as correlation, regression, and confidence intervals.', 'MAT232', 2, 10, 3),
         ('Computer Networking', 'This course provides a comprehensive overview of digital and analog transmission. The course discusses fundamentals of voice, video, and data processing, client-server architectures, Open Systems Interconnect Model (OSI), Network Components, Local Area Networks (LAN), and Wide Area Networks (WAN), and cutting edge technologies. In addition fundamentals of Ethernet, TCP/IP, and other high-speed protocols, broadband communication systems will also be presented. Participating students actively learn via case studies that provide “real-world” examples and scenarios of modern state-of-the-art data communication systems.', 'INT301', 2, 10, 3),
		 ('Scientific & Technical Writing', 'Students will develop the skills necessary for writing about scientific, environmental, medical, and technological topics. Emphasis is placed on making complex and technical information understandable to a variety of audiences. Prerequisites: ENG 122 or fulfillment of General Education Written Communication Competency II requirement and fulfillment of General Education Scientific Reasoning requirement.', 'ENG328', 3, 12, 3),
		 ('Principles of Macroeconomics', 'Introduction to national income determination and the equilibrium level of output and employment. Monetary and fiscal policies as well as open economy issues are discussed. Recommended prerequisites: Fulfillment of the General Education Critical Thinking core competency and Digital Literacy competency.', 'ECO203', 2, 10, 3),
		 ('System Administration & Security', 'In this course, students will learn how to manage the technology that affects organizations. Concepts covered include security best practices, access control, network components and services, change management, and configuration management. Students will gain an understanding of how the services offered by the various network components should be managed and protected. Prerequisite: INT 301.', 'CYB300', 3, 10, 3),
		 ('Information Security Management', 'This course introduces students to skills, knowledge, techniques, and tools required by information technology security professionals. Topics include application security principles and techniques, network security mechanisms, cryptography, and secure programming techniques including cross-site scripting, and SQL injection. Prerequisite: CST 301', 'CST316' , 3, 10, 3),
		 ('Software Testing', 'This course introduces students to software testing and quality control concepts, principles, and methodologies. The emphasis here is on understanding software testing process, planning, strategy, criteria, and testing methods, as well as software quality assurance concepts & control process. It covers the various subjects, including test models, test design techniques (black box and white-box testing techniques), integration, regression, and system testing methods. Prerequisite: CST 301', 'CST313', 2, 10, 3),
		 ('Software Development', 'This course introduces students to modern software development principles and practices. It provides the necessary grounding on the different technologies associated with developing business websites. Students in this course will learn client-side web development (such as HTML5, CSS3, and Bootstrap); as well as server-side web development using PHP programing language. Prerequisite: CST 301', 'CST310', 3, 10, 3),
		 ('Software Architecture & Design', 'This course introduces basic concepts and principles about software architecture and design. It starts with discussion on architectural structures and styles, followed by coverage of design issues and design patterns. The emphasis is on the interaction between software design and quality attributes such as availability, performance, security, interoperability, and modifiability. Prerequisite: CST 301', 'CST307', 3, 10, 3),
		 ('Software Technology & Design', 'In this course, students will learn the application of theory, knowledge, and practices to effectively and efficiently build reliable software systems that satisfy the requirements of customers and users. Students will understand all phases of the lifecycle of a software system, including requirements analysis and specification, software architecture, design patterns and concerns, software development methodologies (i.e. waterfall and agile process development), and software testing. Prerequisite: CPT 310.', 'CST301', 3, 10, 3),
		 ('Data Structures, Algorithms & Designs', 'In this course, students will learn data structure foundations; concepts, and features of object-oriented programming, arrays, stacks, queues, lists; and trees. Students will analyze different sorting and searching algorithms. Emphasis is placed on the appropriate use and choice of standard data structures. Prerequisite: CPT 200.', 'CPT307', 3, 10, 3),
		 ('Operating Systems Theory & Design', 'This course will introduce students to the fundamental concepts and techniques for Operating Systems Theory and Design. Students will learn the operating system concepts including implementation, processes, deadlocks, communication, multi-processing, multilevel memory management, file systems, protection, resource allocation, and scheduling. This course is designed to provide students with an overview of operating systems principles, implementations, and methodologies. Prerequisite: CPT 200.', 'CPT304', 3, 10, 3),
		 ('Computer Organization & Architecture', 'This course provides students with an opportunity to form a strong understanding of the design and architecture of modern computers. In this course, students will learn the principles of computer organization and basic architecture concepts, including computer instruction, the arithmetic of computers, and memory hierarchy and technologies. Prerequisite: CPT 200.', 'CPT301', 3, 10, 3),
		 ('Fundamentals of Programming Languages', 'This course will introduce students to the fundamentals of computer programming. Students will learn fundamentals of computer programming including primitive data types, expressions, control statements, functions, and arrays. Students in this course will be using Python programing language. Python is a widely used high-level, general-purpose, interpreted, dynamic programming language.', 'CPT200', 3, 10, 3),
		 ('Capstone for Computer Software Technology', 'This course will offer an opportunity for students to work on real-life problems through an applied project in a teamwork environment. This course will cover the major software development lifecycle phases: software requirements gathering, software architecture & design, software development, software testing, and software project management. Students are required to apply appropriate methodologies to the activities in the aforementioned phases based on the selected topic. Each group of students will report their progress through a weekly interactive assignment and receive feedback from the instructor. Upon the completion of the course, each group will be required to submit a professional technical report and a working software demonstration. Prerequisites: GEN 499. This course must be taken last in the program.', 'CST499', 3, 10, 3),
		 ('General Education Capstone', 'This course provides students with a cumulative and integrative learning experience grounded in their general education experience. Through the study of selected interdisciplinary topics and course-embedded assessments students will demonstrate mastery of essential competencies and application of different ways of knowing. Students will apply the general education principles informed by ethical and critical sensibility and provide evidence of growth in acquiring the habits of active citizenship. A minimum grade of “C – “ is required to meet course requirements.', 'GEN499', 2, 15, 3),
		 ('Database Systems & Management', 'This course introduces the students to fundamentals of database design, modeling, and relational databases. Students will utilize the concepts to construct and test a database and associated application components. The developments of efficient database application systems require an understanding of fundamentals of database management system. Prerequisite: CPT 307.', 'CPT310', 3, 10, 3),
		 ('Fundamentals of Information Technology & Literacy', 'This course is designed to prepare students for their degree program path. The Fundamentals of Information Technology and Literacy course covers concepts to enable fluency in Information Technology (IT), a fluency that the National Research Council (NRC) considers an important component of the life-long learning process. This course includes a review of basic concepts needed for the program including topics such as operating systems and computer components, hardware and software, basics of database, programming and system design, and other concepts that encourages critical thinking.', 'INT100', 2, 15, 3),
		 ('Scrum Basics', 'This course teaches the framework of Scrum as used in project management as it applies to software development and many other applications. A comparison to predictive (waterfall) methodology is made. Scrum terminology, team responsibilities, and values are introduced. Tools to organize and track Scrum projects are reviewed. Course materials are aligned with Scrum.org and encourage students that so desire to take the Professional Scrum Master I certification exam. Individuals with PSM I certifications often continue to earn additional levels of Scrum Master and related certifications. Links to exam study materials are provided. Note: Students will be responsible for registering and paying for the actual certification test as administered by Scrum.org.', 'TMG300', 3, 10, 3),
		 ('Tutoring for CST', 'This is a one on one tutoring course for the Computer Software Technology program.', 'CST99', 1, 1, 0)
;

INSERT INTO tblavailablecourses (courseId, termId, yearId)
  VALUES (14, 3, 1),
         (13, 3, 1),
		 (12, 1, 2),
		 (11, 1, 2),
		 (17, 2, 2),
		 (10, 3, 2),
		 (9, 1, 2),
		 (8, 1, 2),
		 (7, 2, 2),
		 (6, 2, 2),
		 (5, 2, 3),
		 (2, 3, 2),
		 (16, 1, 3),
		 (15, 2, 3),
		 (4, 3, 2),
		 (3, 1, 3),
		 (18, 1, 3),
		 (1, 1, 3),
		 (19, 2, 3),
		 (20, 1, 3)
;

INSERT INTO tblterm (term) VALUES ('FALL'),('WINTER'),('SPRING');

INSERT INTO tblyear (year) VALUES (2022),(2023),(2024),(2025);
