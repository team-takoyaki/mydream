DROP TABLE DR_DREAM;
DROP TABLE DR_USER;
DROP TABLE DR_CATEGORY;
DROP TABLE DR_SNS_ID;
DROP TABLE DR_SNS;
DROP TABLE DR_DREAM_COMMENT;

CREATE TABLE DR_DREAM (
       ID SERIAL,
       TITLE VARCHAR(255) NOT NULL,
       BODY VARCHAR(2048) NOT NULL,
       CATEGORY_ID VARCHAR(255) NOT NULL,
       USER_ID INTEGER NOT NULL,
       UPDATE_DATE TIMESTAMP DEFAULT "timestamp"('now'::text) NOT NULL,
       CREATE_DATE TIMESTAMP DEFAULT "timestamp"('now'::text) NOT NULL,
       PRIMARY KEY (ID)
);

CREATE TABLE DR_USER (
       ID SERIAL,
       USER_NAME VARCHAR(16) NOT NULL UNIQUE,
       USER_IMAGE VARCHAR(1024),
       SNS_ID INTEGER NOT NULL,
       SNS_USER_ID VARCHAR(64),
       UPDATE_DATE TIMESTAMP DEFAULT "timestamp"('now'::text) NOT NULL,
       CREATE_DATE TIMESTAMP DEFAULT "timestamp"('now'::text) NOT NULL,
       PRIMARY KEY(ID)
);

CREATE TABLE DR_CATEGORY (
       ID SERIAL,
       CATEGORY_NAME VARCHAR(255) NOT NULL UNIQUE,
       CREATE_DATE TIMESTAMP DEFAULT "timestamp"('now'::text) NOT NULL,
       PRIMARY KEY(ID)
);

CREATE TABLE DR_SNS (
       ID SERIAL,
       SNS_NAME VARCHAR(255) NOT NULL UNIQUE,
       CREATE_DATE TIMESTAMP DEFAULT "timestamp"('now'::text) NOT NULL,
       PRIMARY KEY(ID)
);

CREATE TABLE DR_DREAM_COMMENT (
       ID SERIAL,
       DREAM_ID INTEGER NOT NULL,
       BODY VARCHAR(2048) NOT NULL,
       USER_ID INTEGER NOT NULL,
       UPDATE_DATE TIMESTAMP DEFAULT "timestamp"('now'::text) NOT NULL,
       CREATE_DATE TIMESTAMP DEFAULT "timestamp"('now'::text) NOT NULL,
       PRIMARY KEY(ID)
);

CREATE TABLE DR_COMMENT_CHEER (
       COMMENT_ID INTEGER NOT NULL,
       USER_ID INTEGER NOT NULL,
       CREATE_DATE TIMESTAMP DEFAULT "timestamp"('now'::text) NOT NULL,
);

GRANT ALL ON dr_dream TO takoyaki;
GRANT ALL ON dr_dream_id_seq TO takoyaki;
GRANT ALL ON dr_user TO takoyaki;
GRANT ALL ON dr_user_id_seq TO takoyaki;
GRANT ALL ON dr_category TO takoyaki;
GRANT ALL ON dr_category_id_seq TO takoyaki;
GRANT ALL ON dr_sns TO takoyaki;
GRANT ALL ON dr_sns_id_seq TO takoyaki;
GRANT ALL ON dr_dream_comment TO takoyaki;
GRANT ALL ON dr_dream_comment_id_seq TO takoyaki;
GRANT ALL ON dr_comment_cheer TO takoyaki;

