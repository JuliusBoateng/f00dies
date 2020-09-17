#!/usr/bin/env python3
from selenium import webdriver
from selenium.webdriver.support.wait import  WebDriverWait
import time
import os
import json
import re

class Item():
    def __init__(self,name,cal, dh, allergens):
        self.name = name
        self.cal = cal
        self.dh = dh
        self.allergens = ','.join(allergens)
    def __str__(self):
        if len(self.allergens) < 2:
            return "" + self.name + "," + self.dh + ',' + self.cal
        else:
            return "" + self.name + "," + self.dh + ',' + self.cal + "," + self.allergens
    def __eq__(self, other):
        return self.name == other.name and self.cal == other.cal


allnames = []
driver = webdriver.Firefox()
driver.get('http://nutrition.nd.edu')
FullMenu = []
for i in range(3,40): 
    if i == 6 or i == 10 or i == 24 or i == 25 or i == 29 or i == 33:
        continue  
    driver.execute_script('unitsSelectUnit({});'.format(i))
    CatMenu = []
    tds = WebDriverWait(driver,5).until(lambda driver: driver.find_elements_by_class_name("cbo_nn_itemHover"))
    for td in tds:
        td.click()
        time.sleep(.2)
        try:
            item_name_header = driver.find_elements_by_class_name('cbo_nn_LabelHeader')
            item_name = [ x.get_attribute('innerHTML').replace("&nbsp;", "") for x in item_name_header ]
            item_calorie_header = driver.find_elements_by_class_name('cbo_nn_SecondaryNutrient')
            item_calorie = item_calorie_header[0].get_attribute('innerHTML').replace("&nbsp;", "") # [0] reference gives the Calorie information
            allergens_header = driver.find_elements_by_class_name('cbo_nn_LabelAllergens')
            allergens = [ x.get_attribute('innerHTML').replace("&nbsp;", "") for x in allergens_header ]
            dh = ''
            if i < 25:
                dh = 'SDH'
            else:
                dh = 'NDH'
            item = Item(item_name[0],item_calorie, dh, allergens)
            if item not in FullMenu:
                FullMenu.append(item)
        except:
            print('error')
f = open('output2.txt', 'w+')
for b in FullMenu:
    f.write(str(b))
    f.write('\n')
    print(str(b))
f.close()
driver.quit()     