<%
Dim objMessage 
Set objMessage = Server.CreateObject("CDO.Message") 
objMessage.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/sendusing") = 2 'Send the message using the network (SMTP over the network). 
objMessage.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpserver") = "127.0.0.1"
objMessage.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpserverport") = 25 
objMessage.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpusessl") = False 'Use SSL for the connection (True or False) 
objMessage.Configuration.Fields.Item("http://schemas.microsoft.com/cdo/configuration/smtpconnectiontimeout ") = 60 
objMessage.Configuration.Fields.Update 

With objMessage 
.To = "Ehsan <ehsantemp@yahoo.com>" 
.From = "Nazim <nazim@doratarjumaquran.pk>" 
.Subject = "This is the mail subject" 
.TextBody = "This is the mail message." 
.Send 
End With 
Set objMessage = Nothing
%>