create or replace package body login_package is

function authenticate_user(p_email varchar2, p_password varchar2)
return boolean as 
v_password TRADER.TRADER_PASSWORD%Type;
v_email TRADER.TRADER_PASSWORD%Type;

begin
if p_email is null or p_password is null then

Apex_Util.Set_Session_State('LOGIN_MESSAGE'
                                   ,'Please enter email and password.');
        Return False;
     End If;
     
     Begin
     Select u.TRADER_EMAIL,u.TRADER_PASSWORD into v_email,v_password
     from TRADER u
     where upper(u.TRADER_EMAIL)=upper(p_email) and u.TRADER_PASSWORD = p_password;
     return true;
     exception
      When No_Data_Found Then
      
           -- Write to Session, User not found.
           Apex_Util.Set_Session_State('LOGIN_MESSAGE'
                                      ,'User not found');
           Return False;
     End;
     if v_password<>p_password then
       -- Write to Session, Password incorrect.
        Apex_Util.Set_Session_State('LOGIN_MESSAGE'
                                   ,'Password incorrect');
        Return False;
     End If;
     
     Apex_Util.Set_Session_State('SESSION_EMAIL'
                                ,p_email);
   
     Return True;
  End;
  
  Procedure process_login(p_email varchar2, p_password varchar2, p_app_id number)
  as v_result boolean:=False;
  
  Begin
  v_result:=Authenticate_User(p_email,p_password);
  if v_result=true then
  
    Wwv_Flow_Custom_Auth_Std.Post_Login(p_email -- p_email
                                           ,p_password -- p_password
                                           ,v('APP_SESSION') -- p_session_dd
                                           ,p_app_id || ':1' -- p_Flow_page
                                            );
     Else
        -- Login Failure, redirect to page 101 (Login Page).
        Owa_Util.Redirect_Url('f?p=&APP_ID.:101:&SESSION.');
     End If;
  End;
 
End;
/
     