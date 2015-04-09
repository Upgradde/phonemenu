<%@ page import="com.twilio.PhoneMenu" %>
<%@page contentType="text/xml" %>
<%=	PhoneMenu.getTwiML(request.getParameter("node"),request.getParameter("Digits")) %>
