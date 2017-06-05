#!/usr/bin/python

import datetime
import sqlite3


# Connect to the database
conn = sqlite3.connect("/Volumes/Free/Inventory4/db/Inventory.db")
c = conn.cursor()

# Open/create the report file
report = open("/Volumes/Free/Inventory4/db/MobileReport.php", "wb")

# Verbos mode. 0 = off, 1 = on
v = 1

# Define all of our lists that will be used
mobile_makes = []
mobile_models = []
mobile_total = []
mobile_assigned = []
mobile_available = []

def get_total(which):
    all_total_in_db = c.execute("SELECT ID FROM %s" % (which))
    all_total = all_total_in_db.fetchall()
    total_count = len(all_total)

    return total_count

def get_makes():
    all_makes_in_db = c.execute('SELECT Make FROM mobile ORDER BY Make Asc')
    all_makes = all_makes_in_db.fetchall()

    for make in all_makes:
        if not make in mobile_makes:
            mobile_makes.append(make)

def build_report():
    report.write("<table border=0>")
    report.write("<tr><th align='center'>Total Mobile: "+str(get_total('mobile'))+"</th></tr>")
    report.write("<tr>")

    get_makes()
    for make in mobile_makes:
        make_count_in_db = c.execute("SELECT Model FROM mobile WHERE Make = ?", (make))
        make_count = make_count_in_db.fetchall()
        report.write("<td>"+str(make[0])+": "+str(len(make_count))+"</td>")
    
    report.write("</tr>")
    report.write("</table>")

def html_header():
    htmlHeader = """
        <html>
        <head><title>Mobile Report</title></head>
        <body>
        """

    report.write(htmlHeader)
    report.write("Mobile Device Report For: " + datetime.date.today().strftime("%A") + " " + datetime.date.today().strftime("%B") + " " + datetime.date.today().strftime("%d") + " " + datetime.date.today().strftime("%Y") + "<br><br>")

def html_footer():
    report.write("</body></html>")
    report.close()

html_header()
build_report()
html_footer()

# Close the database connection
conn.close()
