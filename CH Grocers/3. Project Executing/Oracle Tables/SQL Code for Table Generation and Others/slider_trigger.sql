DROP SEQUENCE SLIDER_SEQ;
CREATE SEQUENCE SLIDER_SEQ START WITH 1;

DROP TABLE SLIDER;
CREATE TABLE SLIDER 
   (	SLIDER_ID NUMBER(10) PRIMARY KEY, 
	SLIDER_NAME VARCHAR2(100), 
	SLIDER_IMAGE VARCHAR2(100)
   );


CREATE OR REPLACE TRIGGER  SLIDER_T 
  before insert on SLIDER               
  for each row  
begin   
  if :NEW.SLIDER_ID is null then 
    select SLIDER_SEQ.nextval into :NEW.SLIDER_ID from dual; 
  end if; 
end; 


ALTER TRIGGER SLIDER_T ENABLE;