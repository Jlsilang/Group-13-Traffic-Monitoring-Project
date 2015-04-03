#!/usr/bin/python
print "Content-Type: text/html\n"


'''
Created on Mar 15, 2011

@author: Justin Silang, Charu Jain, Akshay Sardana 
'''

import datetime, TrafficParser, WeatherParser


now = datetime.datetime.now() #Get the current timestamp.

tParse = TrafficParser.TrafficParser() #Create a new TrafficParser object
wParse = WeatherParser.WeatherParser() #Create a new WeatherParser object

print now.hour
tParse.parseTraffic() #Call to parse traffic
if now.hour == 8 or now.hour == 12 or now.hour == 16 or now.hour == 20 or now.hour == 1: #Collect weather only if it matches the specified hour.
    wParse.parseWeather() #Call to parse weather

