CREATE DATABASE xy_credit_cognizance CHARACTER SET utf8 COLLATE utf8_general_ci;

USE xy_credit_cognizance;

CREATE TABLE xy_student(
id CHAR(12) PRIMARY KEY COMMENT '学号',
name VARCHAR(20) COMMENT '姓名',
sex ENUM('man','woman') COMMENT '性别' DEFAULT 'man',
department VARCHAR(50) COMMENT '系部',
specialty VARCHAR(50) COMMENT '专业',
class VARCHAR(50) COMMENT '班级',
instructor VARCHAR(50) COMMENT '辅导员',
remark TEXT COMMENT '备注'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE xy_activity_type(
id CHAR(8) PRIMARY KEY COMMENT '活动类型号',
name VARCHAR(20) NOT NULL UNIQUE COMMENT '活动类型名',
remark TEXT COMMENT '备注'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE xy_activity(
id INT PRIMARY KEY AUTO_INCREMENT COMMENT '活动号',
name VARCHAR(20) NOT NULL COMMENT '活动名称',
introduction TEXT COMMENT '简介',
type_id CHAR(8) COMMENT '活动类型号',
stdcredit SMALLINT COMMENT '标准学分',
date DATE COMMENT '活动日期',
locale VARCHAR(50) COMMENT '活动地点',
people_number SMALLINT COMMENT '人数',
remark TEXT COMMENT '备注',
FOREIGN KEY(type_id) REFERENCES xy_activity_type(id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE xy_activity_participator(
activity_id INT COMMENT '活动号',
student_id CHAR(12) COMMENT '学生学号',
PRIMARY KEY(activity_id, student_id),
FOREIGN KEY(activity_id) REFERENCES xy_activity(id) ON DELETE CASCADE,
FOREIGN KEY(student_id) REFERENCES xy_student(id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE xy_credit(
id INT PRIMARY KEY AUTO_INCREMENT COMMENT '学分ID',
student_id CHAR(12) COMMENT '学生学号',
activity_id INT COMMENT '活动号',
cogizance_state ENUM('-1', '0', '1', '2') DEFAULT '0' NOT NULL COMMENT '认定状态',
cogizance_cause TEXT NOT NULL COMMENT '认定原因',
cogizance_credit SMALLINT COMMENT '认定学分',
cogizant_id CHAR(8) COMMENT '认定者ID',
submit_id CHAR(8) COMMENT '提交者ID',
submit_time DATETIME COMMENT '提交时间',
cogizance_time DATETIME COMMENT '认定时间',
remark TEXT COMMENT '备注',
FOREIGN KEY(student_id) REFERENCES xy_student(id) ON DELETE CASCADE,
FOREIGN KEY(activity_id) REFERENCES xy_activity(id) ON DELETE CASCADE,
FOREIGN KEY(cogizant_id) REFERENCES xy_admin(id) ON DELETE SET NULL,
FOREIGN KEY(submit_id) REFERENCES xy_admin(id) ON DELETE SET NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE xy_user(
id INT PRIMARY KEY AUTO_INCREMENT COMMENT '用户ID',
student_id CHAR(12) UNIQUE COMMENT '学生学号',
password VARCHAR(50) DEFAULT '0000' NOT NULL COMMENT '密码',
remark TEXT COMMENT '备注',
FOREIGN KEY(student_id) REFERENCES xy_student(id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE xy_admin(
id CHAR(8) PRIMARY KEY COMMENT '管理员ID',
name VARCHAR(20) NOT NULL COMMENT '管理员姓名',
role ENUM('normal', 'svip') DEFAULT 'normal' NOT NULL COMMENT '角色',
password VARCHAR(50) DEFAULT '888888' NOT NULL COMMENT '密码',
remark TEXT COMMENT '备注'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELIMITER //
CREATE TRIGGER trigger_student_user_insert
AFTER INSERT
ON xy_student FOR EACH ROW
BEGIN
INSERT INTO xy_user(student_id, password) VALUE(NEW.id, '0000');
END
//
DELIMITER ;

CREATE VIEW xy_activity_view(id, name, introduction, type, stdcredit,
date, locale, people_number, remark) AS SELECT xy_activity.id, xy_activity.name,
xy_activity.introduction, xy_activity_type.name, xy_activity.stdcredit,
xy_activity.date, xy_activity.locale, xy_activity.people_number, xy_activity.remark
FROM xy_activity, xy_activity_type WHERE xy_activity.type_id = xy_activity_type.id;

CREATE VIEW xy_credit_detailed(id, student_id, student_name, activity_id,
activity_name, activity_type, activity_stdcredit, cogizance_credit, cogizance_state,
cogizance_cause, submit_time, submit_id, cogizance_time, cogizant_id, remark)
AS SELECT xy_credit.id, xy_student.id, xy_student.name, xy_activity.id,
xy_activity.name, xy_activity_type.name, xy_activity.stdcredit, xy_credit.cogizance_credit,
xy_credit.cogizance_state, xy_credit.cogizance_cause, xy_credit.submit_time, xy_credit.submit_id,
xy_credit.cogizance_time, xy_credit.cogizant_id, xy_credit.remark FROM xy_credit
LEFT JOIN xy_student ON xy_credit.student_id = xy_student.id
LEFT JOIN xy_activity ON xy_credit.activity_id = xy_activity.id
LEFT JOIN xy_activity_type ON xy_activity.type_id = xy_activity_type.id;
