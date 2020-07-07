# importing the requests library 
import requests 
import pprint
  
# api-endpoint 
URL = "https://192.168.1.212/api/EwxOVEswAQTG-VfGrAYqbUHmGbCAm3sKDOOC-Uz2/lights"
  
 
# defining a params dict for the parameters to be sent to the API 
#PARAMS = {'address':location} 
  
# sending get request and saving the response as response object 
r = requests.get(url = URL) 
  
# extracting data in json format 
data = r.json() 
  
pprint.pprint(data)