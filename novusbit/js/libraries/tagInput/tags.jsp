<%@ page import="net.sf.json.JSONArray, net.sf.json.JSONObject" %><%
  JSONArray jsa= new JSONArray();
  String search=request.getParameter("search")==null?"":request.getParameter("search");
  for (int i=1;i<5;i++){
    JSONObject o= new JSONObject();
    o.element("tag",search+i);
    o.element("freq",i);
    jsa.add(o);
  }
  out.print(jsa.toString());
%>