#!/usr/bin/python

import datetime
import sqlite3
import requests
from bs4 import BeautifulSoup


# Connect to our Inventory database
conn = sqlite3.connect("/Users/Shared/InventoryTest/Inventory/db/Inventory.db")
c = conn.cursor()

# Open/create the report php file
report = open("/Users/Shared/InventoryTest/Inventory/www/php/reports/xeroxreport.php", "wb")

green = """ "bg-success" """

red = """ "bg-danger" """

def xerox_7775_supplies():
    all_7775_ips_in_db = c.execute('SELECT IPAddress, PrinterName FROM printers WHERE Model = "7775" ORDER BY IPAddress Asc')
    all_7775s = all_7775_ips_in_db.fetchall()

    # Setup our html container, table, and headings
    init_table = """
        <div class="container" id="XeroxReport">
        <div class="row">
        <div class="panel panel-default" >
        <div class="panel-heading">Xerox 7775 Supplies</div>
        <table class="table table-sm table-bordered">
        <thead>
        <tr>
        <td>Printer Name</td>
        <td align=center>K1</td>
        <td align=center>K2</td>
        <td align=center>C</td>
        <td align=center>M</td>
        <td align=center>Y</td>
        <td align=center>WC</td>
        <td align=center>R1</td>
        <td align=center>R2</td>
        <td align=center>R3</td>
        <td align=center>R4</td>
        <td align=center>Fuser</td>
        </tr>
        </thead>
        <tbody>
        """
    report.write(init_table)

    for xerox_7775 in all_7775s:
        ip_address = xerox_7775[0]
        printer_name = xerox_7775[1]
        supplies_page = requests.get("http://" + ip_address + "/status/consumables.php")

        if supplies_page.status_code == 200:
            soup = BeautifulSoup(supplies_page.content, 'html.parser')
            td = soup.find_all('td')
            tr = soup.find_all('tr')
            tdindex = [1, 5, 9, 13, 17, 21, 25, 29, 33, 37, 41]
            
            report.write("<tr><td>" + printer_name + "</td>")

            for i in tdindex:
                status = td[i+1].get_text().strip()
                if status != "OK":
                    report.write("<td class=" + red + "></td>")
                else:
                    report.write("<td class=" + green + "></td>")

            report.write("</tr>")

    end_table = """
        <tr>
        <td>Totals:</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        </tbody>
        </table>
        </div> <!-- div panel -->
        """
    report.write(end_table)

def xerox_7855_supplies():
    all_7855_ips_in_db = c.execute('SELECT IPAddress, PrinterName FROM printers WHERE Model = "7855" ORDER BY IPAddress Asc')
    all_7855s = all_7855_ips_in_db.fetchall()
    
    # Setup our html container, table, and headings
    init_table = """
        <div class="container">
        <div class="row">
        <div class="panel panel-default" >
        <div class="panel-heading">Xerox 7855 Supplies</div>
        <table class="table table-sm table-bordered">
        <thead>
        <tr>
        <td>Printer Name</td>
        <td align=center>B</td>
        <td align=center>C</td>
        <td align=center>M</td>
        <td align=center>Y</td>
        <td align=center>R1</td>
        <td align=center>R2</td>
        <td align=center>R3</td>
        <td align=center>R4</td>
        <td align=center>WC</td>
        <td align=center>TB</td>
        <td align=center>2B</td>
        </tr>
        </thead>
        <tbody>
        """
    report.write(init_table)
    
    for xerox_7855 in all_7855s:
        ip_address = xerox_7855[0]
        printer_name = xerox_7855[1]
        supplies_page = requests.get("http://" + ip_address + "/status/consumables.php")
    
        if supplies_page.status_code == 200:
            soup = BeautifulSoup(supplies_page.content, 'html.parser')
            td = soup.find_all('td')
            tr = soup.find_all('tr')
            tdindex = [1, 11, 21, 31, 41, 51, 61, 71, 81, 89, 99]
            
            report.write("<tr><td>" + printer_name + "</td>")

            for i in tdindex:
                status = td[i+1].get_text().strip()
                if status != "OK":
                    report.write("<td class=" + red + "></td>")
                else:
                    report.write("<td class=" + green + "></td>")
                   
            report.write("</tr>")

    end_table = """
        <tr>
        <td>Totals:</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        </tbody>
        </table>
        </div> <!-- div panel -->
        """
    report.write(end_table)

def html_header():
    header = """
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <!-- Bootstrap core CSS -->
        <link href="/www/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
        
        <div class="container">
        <div class="row">
        """
    report.write(header)
    report.write("HE Xerox Printer Report For: " + datetime.date.today().strftime("%A") + " " + datetime.date.today().strftime("%B") + " " + datetime.date.today().strftime("%d") + " " + datetime.date.today().strftime("%Y") + "<br><br>")

def html_footer():
    footer = """
        </div> <!-- div row -->
        <button type="submit" class="btn btn-success pull-right" name="PrintButton" onclick="printDiv(XeroxReport)">Print</button>
        </div> <!-- div container -->
        
        </body>
        </html>
        <script>
        function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        
        document.body.innerHTML = printContents;
        
        window.print();
        
        document.body.innerHTML = originalContents;

        }
        </script>
        """
    report.write(footer)

html_header()
xerox_7855_supplies()
xerox_7775_supplies()
html_footer()

conn.close()
