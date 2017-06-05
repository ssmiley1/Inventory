#!/usr/bin/python

import datetime
import sqlite3
import requests
from bs4 import BeautifulSoup
import smtplib
from email.MIMEMultipart import MIMEMultipart
from email.MIMEText import MIMEText

# Connect to the database
conn = sqlite3.connect("/Volumes/Free/Inventory4/db/Inventory.db")
c = conn.cursor()

# Open/create the report file
report = open("/Volumes/Free/Inventory4/db/XeroxReport.php", "wb")

# Verbos mode. 0 = off, 1 = on
v = 1

# Define all of our lists that will be used
supply_report = []
drums_7775 = []
drums_7855 = []
waste_7775 = []
waste_7855 = []
bias_7855 = []
transfer_7855 = []
xerox_7775_names = []

def check_7855s():
    all_7855s_ips_in_db = c.execute('SELECT IPAddress FROM printers WHERE Model = "7855" ORDER BY IPAddress Asc')
    all_7855s_ips = all_7855s_ips_in_db.fetchall()
    
    header_7855 = """
        <table style="border:1px solid black">
        <tr style="border:1px solid black">
        <th align=right>7855 Name</th>
        <th width=30px>B</th>
        <th width=30px>C</th>
        <th width=30px>M</th>
        <th width=30px>Y</th>
        <th width=30px>R1</th>
        <th width=30px>R2</th>
        <th width=30px>R3</th>
        <th width=30px>R4</th>
        <th width=30px>WC</th>
        <th width=30px>TB</th>
        <th width=30px>2B</th>
        </tr>
        """
    
    report.write(header_7855)
    
    Blackcount = 0
    Cyancount = 0
    Magentacount = 0
    Yellowcount = 0
    R1count = 0
    R2count = 0
    R3count = 0
    R4count = 0
    Wastecount = 0
    TransferBeltcount = 0
    SecondBiascount = 0
    

    for ip in all_7855s_ips:
        current_xerox_7855 = "http://" + ip[0] + "/status/consumables.php"
        supplies_page = requests.get(current_xerox_7855)
        
        if supplies_page.status_code != 200:
            current_xerox_7855 = "http://" + ip[0] + "/stat/consumables.php"
            supplies_page = requests.get(current_xerox_7855)
        
        xerox_7855_name_in_db = c.execute('SELECT PrinterName FROM printers WHERE IPAddress = ?', (ip))
        xerox_7855_name = xerox_7855_name_in_db.fetchall()
        xerox_7855_name = xerox_7855_name[0]
        report.write("<tr><td align=right>" + str(xerox_7855_name[0]) + "</td>")
        
        if supplies_page.status_code == 200:
            if v == 1: print ip[0] + " - " + xerox_7855_name[0] + ":"
            soup = BeautifulSoup(supplies_page.content, 'html.parser')

            td = soup.find_all('td')
            tr = soup.find_all('tr')
            tdindex = [1, 11, 21, 31, 41, 51, 61, 71, 81, 89, 99]
        
            for i in tdindex:
                supply = td[i].get_text()
                supply = supply.strip()
                status = td[i + 1].get_text()
                if v == 1: print str(status)
                status = status.strip()
                
                if status != "OK":
                    if v == 1: print supply + " " + status + " *****"
                    supply_report.append(xerox_7855_name[0] + " - " + supply + " " + status)
                    report.write("<td bgcolor=e74c3c width=20px></td>")
                    
                    if "Black Toner" in supply: Blackcount += 1
                    if "Cyan Toner" in supply: Cyancount += 1
                    if "Magenta Toner" in supply: Magentacount += 1
                    if "Yellow Toner" in supply: Yellowcount += 1
                    if "(R1)" in supply: R1count += 1
                    if "(R2)" in supply: R2count += 1
                    if "(R3)" in supply: R3count += 1
                    if "(R4)" in supply: R4count += 1
                    if "Waste Toner" in supply: Wastecount += 1
                    if "Belt Cleaner" in supply: TransferBeltcount += 1
                    if "Second Bias" in supply: SecondBiascount += 1
                
                    if "Drum" in supply:
                        drums_7855.append(xerox_7855_name[0] + " - " + supply + " " + status)
            
                    if "Waste" in supply:
                        waste_7855.append(xerox_7855_name[0] + " - " + supply + " " + status)
            
                    if "Roll" in supply:
                        bias_7855.append(xerox_7855_name[0] + " - " + supply + " " + status)
            
                    if "Belt" in supply:
                        transfer_7855.append(xerox_7855_name[0] + " - " + supply + " " + status)
                
                
                else:
                    if v == 1: print supply + " " + status
                    report.write("<td bgcolor=27ae60 width=20px></td>")

            if v == 1: print "\n"
            report.write("</tr>")
        

        else:
            supply_report.append(xerox_7855_name[0] + " - " + ip[0] + " - " + ": OFFLINE.")
            if v == 1: print xerox_7855_name[0] + " - " + ip[0] + " - " +  + ": OFFLINE.\n"

    report.write("<tr><td align=right>TOTALS:</td><td align=center>" + str(Blackcount) + "</td><td align=center>" + str(Cyancount) + "</td><td align=center>" + str(Magentacount) + "</td><td align=center>" + str(Yellowcount) + "</td><td align=center>--</td><td align=center>--</td><td align=center>-></td><td align=center>" + str(R1count+R2count+R3count+R4count) + "</td><td align=center>" + str(Wastecount) + "</td><td align=center>" + str(TransferBeltcount) + "</td><td align=center>" + str(SecondBiascount) + "</td></tr></table>")

def check_7775s():
    all_7775s_ips_in_db = c.execute('SELECT IPAddress FROM printers WHERE Model = "7775" ORDER BY IPAddress Asc')
    all_7775s_ips = all_7775s_ips_in_db.fetchall()
    
    header_7775 = """
        <table style="border:1px solid black">
        <tr style="border:1px solid black">
        <th align=right>7775 Name</th>
        <th width=30px>K1</th>
        <th width=30px>K2</th>
        <th width=30px>C</th>
        <th width=30pxx>M</th>
        <th width=30px>Y</th>
        <th width=30px>WC</th>
        <th width=30px>R1</th>
        <th width=30px>R2</th>
        <th width=30px>R3</th>
        <th width=30px>R4</th>
        <th width=30px>Fuser</th>
        </tr>
        """
    
    report.write(header_7775)
    
    K1count = 0
    K2count = 0
    Cyancount = 0
    Magentacount = 0
    Yellowcount = 0
    Wastecount = 0
    R1count = 0
    R2count = 0
    R3count = 0
    R4count = 0
    Fusercount = 0

    for ip in all_7775s_ips:
        current_xerox_7775 = "http://" + ip[0] + "/status/consumables.php"
        supplies_page = requests.get(current_xerox_7775)
        xerox_7775_name_in_db = c.execute('SELECT PrinterName FROM printers WHERE IPAddress = ?', (ip))
        xerox_7775_name = xerox_7775_name_in_db.fetchall()
        xerox_7775_name = xerox_7775_name[0]
        report.write("<tr><td align=right>" + str(xerox_7775_name[0]) + "</td>")

        
        if supplies_page.status_code == 200:
            if v == 1: print ip[0] + " - " + xerox_7775_name[0] + ":"
            soup = BeautifulSoup(supplies_page.content, 'html.parser')
            
            td = soup.find_all('td')
            tr = soup.find_all('tr')
            tdindex = [1, 5, 9, 13, 17, 21, 25, 29, 33, 37, 41]
            
            for i in tdindex:
                supply = td[i].get_text()
                supply = supply.strip()
                status = td[i + 1].get_text()
                status = status.strip()
                
                if status != "OK":
                    if v == 1: print supply + " " + status + " *****"
                    report.write("<td bgcolor=e74c3c width=20px></td>")
                    supply_report.append(xerox_7775_name[0] + " - " + supply + " " + status)
                    
                    if "(K1)" in supply: K1count += 1
                    if "(K2)" in supply: K2count += 1
                    if "(C)" in supply: Cyancount += 1
                    if "(M)" in supply: Magentacount += 1
                    if "(Y)" in supply: Yellowcount += 1
                    if "Waste Container" in supply: Wastecount += 1
                    if "(R1)" in supply: R1count += 1
                    if "(R2)" in supply: R2count += 1
                    if "(R3)" in supply: R3count += 1
                    if "(R4)" in supply: R4count += 1
                    if "Fuser" in supply: Fusercount += 1
                
                    if "Drum" in supply:
                        drums_7775.append(xerox_7775_name[0] + " - " + supply + " " + status)
            
                    if "Waste" in supply:
                        waste_7775.append(xerox_7775_name[0] + " - " + supply + " " + status)
                
                else:
                    if v == 1: print supply + " " + status
                    report.write("<td bgcolor=27ae60 width=20px></td>")
    
            if v == 1: print "\n"
            report.write("</tr>")

        else:
            supply_report.append(xerox_7775_name[0] + " - " + ip[0] + " - " + ": OFFLINE.")
            if v == 1: print xerox_7775_name[0] + " - " + ip[0] + " - " +  + ": OFFLINE.\n"

    report.write("<tr><td align=right>TOTALS:</td><td align=center>" + str(K1count) + "</td><td align=center>" + str(K2count) + "</td><td align=center>" + str(Cyancount) + "</td><td align=center>" + str(Magentacount) + "</td><td align=center>" + str(Yellowcount) + "</td><td align=center>" + str(Wastecount) + "</td><td align=center>" + str(R1count) + "</td><td align=center>--</td><td align=center>-></td><td align=center>" + str(R2count+R3count+R4count) + "</td><td align=center>" + str(Fusercount) + "</td></tr></table>")

def print_report():
    
    count = 0
    
    print "PRINTER SUPPLY REPORT:"
    for i in supply_report:
        print i
    
    print ""
    print "LOW 7855 DRUMS:"
    for low_7855_drum in drums_7855:
        print low_7855_drum

    print ""
    print "LOW 7855 TONER WASTE CONTAINERS:"
    for low_7855_waste in waste_7855:
        print low_7855_waste

    print ""
    print "LOW 7855 TRANSFER BELT:"
    for low_7855_transfer in transfer_7855:
        print low_7855_transfer

    print ""
    print "LOW 7855 2ndary BIAS ROLL:"
    for low_7855_bias in bias_7855:
        print low_7855_bias

    print ""
    print "LOW 7775 DRUMS:"
    for low_7775_drum in drums_7775:
        print low_7775_drum

    print ""
    print "LOW 7775 TONER WASTE CONTAINERS:"
    for low_7775_waste in waste_7775:
        print low_7775_waste

def html_header():
    htmlHeader = """
        <html>
        <head><title>Printer Report</title></head>
        <body>
        """

    report.write(htmlHeader)
    report.write("HE Xerox Printer Report For: " + datetime.date.today().strftime("%A") + " " + datetime.date.today().strftime("%B") + " " + datetime.date.today().strftime("%d") + " " + datetime.date.today().strftime("%Y") + "<br><br>")

def html_footer():
    report.write("</body></html>")
    report.close()

html_header()
check_7855s()
report.write("<br><br>")
check_7775s()

# Only print out the report if we are in verbose mode
if v == 1:
    print_report()

html_footer()

# Close the database connection
conn.close()
