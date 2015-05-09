#!/usr/bin/python
print "Content-Type: text/html\n"
'''
Created on Mar 18, 2011

@author: aditya devarakonda
'''
import urllib
import MySQLdb

#Encompasses all the necessary methods and data structures necessary for collecting, parsing and adding weather
#information to the mysql database.
class WeatherParser:
#Initializes the necessary variables required for the parser.
#All objects are initalized to NULL and all numerical types are initialized to 0.
    def __init__(self):
        self.sock = None #A socket object which opens up a port to weather.com
        self.db = None #A database object which opens a link to the MySQL database
        self.cursor = None #A database cursor object which executes and reads the database. 
        self.htmlsrc = None #A String which stores the HTML source code for the traffic incidents
        self.urltup = None #A tuple which stores the URL for the RSS weather feeds.
	self.ziptup = None #A tuple which stores the city name and zipcodes.
        self.count = 0 #A counter variable used during the parsing phase

#The main method which is called by the CollectScript to initiate the weather collection process      
    def parseWeather(self):
        self.urltup = ("http://rss.weather.com/weather/rss/local/07054",\
                       "http://rss.weather.com/weather/rss/local/08837",\
                       "http://rss.weather.com/weather/rss/local/08759") #URLs for the RSS weather conditions.
        self.ziptup = ("Parsippany","07054",\
                       "Edison","08837",\
                       "Manchester Township","08759")#City name/zipcode pair which need to be stored.
        for i in self.urltup: #Need to parse the HTML sources for each item in the url tuple.
            self.sock = urllib.urlopen(i) #Open a socket to the RSS page.
            self.htmlsrc = self.sock.read() #Read the corresponding HTML source.
            self.sock.close()
            
            for item in self.htmlsrc.split("</description>"): #Skip through all the tags which do not match "Current Weather Conditions". 
                if "Current Weather Conditions" in item: #If HTML tag matches then proceed with the parsing.
                        #Store the important fields into temporary variables.
                        weather = item[item.find("/>")+2:item.find(". For")]
                        conditions =  weather[:weather.find(",")]
                        temp =  weather[weather.find(", and")+6:weather.find("&")]
                        city = self.ziptup[self.count]
                        self.count = self.count + 1
                        zipcode = self.ziptup[self.count]
                        print "DEBUGGER: %s %s %s %s" %(city,zipcode,conditions, temp) #DEBUGGING PURPOSES
                        self.dbadd(conditions, temp, city, zipcode)
                        
            self.count = self.count +1
        #print "" DEBUGGING PURPOSES
        self.count = 0
            
    def dbadd(self,conditions,temp,city,zipcode):
        self.db = MySQLdb.connect("localhost", "jlsilang_jc", "Runescape1", "jlsilang_DB")#Make a connection to the database with the necessary credentials.
        self.cursor = self.db.cursor()
        
        sql_cmd = """INSERT INTO WEATHER(
                     CREATE_DATE,
                     CREATE_TIME,
                     CONDITIONS,
                     TEMPERATURE,
                     CITY_NAME,
                     ZIPCODE)
                     VALUES (CURDATE(),CURTIME(),'%s','%s','%s','%s')""" \
                     %(conditions,temp,city,zipcode) #SQL Command to store the parsed weather information.                   
        try: #cursor.execute may throw an exception which can corrupt database entries.
            self.cursor.execute(sql_cmd) #Execute the SQL command.
            self.db.commit() #Make all changes to the database, permanent.
            return
        except: #If an exception is encountered, print an error message and undo any changes to the database.
            print "Error adding new entry"
            self.db.rollback()
            return 
