from seleniumwire import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.keys import Keys
from pathlib import Path
import pandas as pd
import time
import os
import pyodbc
import datetime

options = webdriver.ChromeOptions()
options.headless = True

# Set the download directory path
downloads_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'descargas')
print(downloads_path)

options.add_experimental_option("prefs", {"download.default_directory": downloads_path})

driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()), options=options)
# driver = webdriver.Chrome(chrome_options=options)
driver.get('chrome://settings/clearBrowserData')
# user32 = ctypes.WinDLL('user32')
# SW_MAXIMISE = 3
# hWnd = user32.GetForegroundWindow()
# user32.ShowWindow(hWnd, SW_MAXIMISE)

driver.get("https://soloverde.rexmas.cl/remuneraciones/es-CL/login")

time.sleep(2)

user = driver.find_element("id","username")
user.send_keys("Consultas")

#insertamos los datos de la contraseña por ID
con = driver.find_element("id","password")
con.send_keys("Config03")
con.send_keys(Keys.RETURN)

time.sleep(2)

driver.get('https://soloverde.rexmas.cl/remuneraciones/es-CL/rexisa/gecos/1122/ejecutar')

time.sleep(5)

wait = WebDriverWait(driver, 20)
button = wait.until(EC.element_to_be_clickable((By.XPATH, "/html/body/div[1]/div[3]/div[2]/div[2]/form/div[2]/div/input")))
button.click()

time.sleep(100)
