create or replace package login_package is

function authenticate_user(p_email varchar2, p_password varchar2)
return boolean;

procedure process_login(p_email varchar2, p_password varchar2,p_app_id number);
end login_package;
/