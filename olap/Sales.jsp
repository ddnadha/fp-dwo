<%@ page session="true" contentType="text/html; charset=ISO-8859-1" %>
    <%@ taglib uri="http://www.tonbeller.com/jpivot" prefix="jp" %>
        <%@ taglib prefix="c" uri="http://java.sun.com/jstl/core" %>


            <jp:mondrianQuery id="query01" jdbcDriver="com.mysql.jdbc.Driver"
                jdbcUrl="jdbc:mysql://localhost/dwaw23?user=root&password="
                catalogUri="/WEB-INF/queries/SalesFact.xml">

                select {[Measures].[TotalDue], [Measures].[TotalOrder]} ON COLUMNS,
                {([Time].[All Times],[Store].[All Stores],[Shipment].[All Shipments],[Product].[All Products])} ON ROWS
                from [Sales]


            </jp:mondrianQuery>





            <c:set var="title01" scope="session">Query AdventureWorks Purchase using Mondrian OLAP</c:set>