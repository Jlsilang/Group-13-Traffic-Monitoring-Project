#!/usr/bin/python
print "Content-Type: text/html\n"
'''
Created on Feb 22, 2011

@author: aditya devarakonda
'''
import urllib
import MySQLdb

#Encompasses all the necessary methods and data structures necessary for collecting, parsing and adding traffic
#information to the mysql database.
class TrafficParser:
#Initializes the necessary variables required for the parser.
#All objects are initalized to NULL and all numerical types are initialized to 0.
    def __init__(self):
        self.sock = None #A socket object which opens up a port to 511nj.org
        self.count = 0 #A counter variable used during the parsing phase
        self.htmlsrc = None #A String which stores the HTML source code for the traffic incidents
        self.db = None #A database object which opens a link to the MySQL database
        self.cursor = None #A database cursor object which executes and reads the database. 

#The main method which is called by the CollectScript to initiate the traffic collection process
    def parseTraffic(self):
       #http://www.511nj.org/IncidentList.aspx?listType=IncidentsCongestion
        self.sock =  (urllib.urlopen('http://www.511nj.org/IncidentList.aspx?listType=IncidentsCongestion')) #Open the url to 511nj.org
        self.htmlsrc = self.sock.read() #Read the HTML source to the opened website.
        self.sock.close() #Close the socket since its no longer needed.
       
        for item in self.htmlsrc.split("</div>"): #Skip through all of the unnecessary HTML tags.
            
            if "<div id=\"ctl00_cphContent_ctl01\">" in item: #If HTML tag matches "IncidentList", begin parsing.
                for i in item.split("</tr>"):#Skip through all of the unnecessary fields within "IncidentList"
                  
                    if i.find("Lat=") >= 0 : #If tag matches "Latitude", need to store.
                        Lat =  i[i.find("Lat=")+4:i.find("&Lon")]
                        
                    if i.find("Lon=") >= 0: #If tag matches "Longitude", need to store.
                        Lon =  i[i.find("Lon=")+4:i.find("'>As of")]
                        
                    for j in i.split("</td>"): #Skip through all unnecessary fields until "Road Name"
                        if j == "\r\n":
                            continue
                        elif self.count == 1:
                            Desc =  j[j.find(">")+1:] #First tag encountered holds the incident description.
                            self.count = self.count+1
                        elif self.count == 2: #Second tag encountered holds the Road Name.
                            Road = j[j.find(">")+1:]
                            if Road.find("Atlantic City Expressway") >= 0 or Road.find("Garden State Parkway") >= 0 or Road.find("New Jersey Turnpike") >=0 or Road.find("I-78") >=0 or Road.find("I-287") >=0 or Road.find("I-80") >=0 or Road.find("I-195") >=0 or Road.find("I-295") >=0: #Store data if road matches
                                print" %s LONGITUDE: %s DESCRIPTION: %s ROAD: %s" % (Lat,Lon,Desc,Road)        #DEBUGGING PURPOSES
                                self.dbadd(Lat, Lon, Desc, Road) #Call database add method once the data is populated.
                            self.count = self.count +1
                        else:
                            self.count=self.count+1
                    self.count=0 #Reset count for the next incident.
              #  print ""      #  DEBUGGING PURPOSES

#This method is used to interface with the database and add to the Traffic database table, takes the stored fields as input: Latitude, Longitude, Incident Type and Road Name.    
    def dbadd(self, lat, lon, type, road):
        print "is it adding"
        self.db = MySQLdb.connect("localhost", "jlsilang_jc", "Runescape1", "jlsilang_DB") #Make a connection to the database with the necessary credentials.
        self.cursor = self.db.cursor() #Create a cursor in order to execute and read results from the database
        sql_cmd = """SELECT * FROM TRAFFIC WHERE 
                    LONGITUDE = '%s' AND 
                    LATITUDE = '%s' AND
                    INCIDENT_TYPE = '%s' AND ROAD_NAME='%s'""" %(lon,lat,type,road) #SQL command to check if this is a duplicate entry.
        try: #cursor.execute may throw an exception which can corrupt database entries.
            self.cursor.execute(sql_cmd) #Execute the duplicity check SQL command.
            result = self.cursor.fetchall()
            
            if result == (): #If the tuple is NULL, we have a unique entry.
                
                sql_cmd = """INSERT INTO TRAFFIC(
                             CREATE_DATE,
                             CREATE_TIME,
                             LATITUDE,
                             LONGITUDE,
                             INCIDENT_TYPE,
                             ROAD_NAME)
                             VALUES (CURDATE(),CURTIME(),'%s','%s','%s','%s')""" %(lat,lon,type,road) #SQL command to add a new database entry.
                try: #cursor.execute may throw an exception
                    self.cursor.execute(sql_cmd)
                    self.db.commit() #make the database changes permanent. 
                    return
                except: #If there is an exception print out an error message and undo changes to the database.
                    print("Error adding new entry")
                    self.db.rollback()
                    return
            else: #Encountered a duplicate entry, need set UPDATE_TIME and UPDATE_DATE to the appropriate values.
                sql_cmd = """UPDATE TRAFFIC SET UPDATE_TIME=CURTIME(),
                            INCIDENT_TYPE='%s', UPDATE_DATE = CURDATE(),
                            ROAD_NAME='%s' WHERE LATITUDE='%s' AND LONGITUDE='%s'""" %(type,road,lat,lon)
                try:
                    self.cursor.execute(sql_cmd)
                    self.db.commit()
                    return
                except:
                    print "Error updating existing entry"
                    self.db.rollback()
                    return
        except:
            print "Error: unable to fetch data"
        
        self.db.close()
