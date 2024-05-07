import threading
import time
import tkinter as tk
import requests
import logging
from tkinter import ttk


# Налаштування ведення журналу з файловим обробником
# logging.basicConfig(filename='log.log', level=logging.DEBUG)

# Глобальна змінна для зберігання ID
request_id = None

# Функція для запису запитів і відповідей
def log_request(url, response):
    logging.info("Запит: %s", url)
    logging.info("Код відповіді: %s", response.status_code)
    if response.content:
        logging.info("Відповідь: %s", response.content.decode())

# Функція для оновлення запиту (виконується в головному потоці)
def update_request():
    global request_id
    # Отримання ID, введеного користувачем (безпечний доступ у головному потоці)
    id = entry.get()
    # Перевірка, чи ID не порожній
    if not id:
        return
    # Оновлення ID запиту
    request_id = id
    # Виклик get_data_and_log з веденням журналу
    get_data_and_log()

    # Запланувати наступне оновлення через 3 хв. (внутрішньо функції)
    window.after(180000, update_request)  # Запланувати оновлення кожні  3 хв

# Функція для отримання даних і запису журналу
def get_data_and_log():
    global request_id
    try:
        url = f"{request_id}"
        response = requests.get(url)
        response.raise_for_status()  # Викликати виняток для кодів статусу, відмінних від 200
        status = "успішний"
    except requests.exceptions.RequestException as e:
        status = f"невдалий ({e})"

    # Оновлення інтерфейсу користувача в головному потоці (безпечний підхід)
    window.after(0, lambda: status_label.config(text=f"{time.strftime('%H:%M:%S')} - {status}"))

    # Запис запиту та відповіді в журнал
    log_request(url, response)

# Створення головного вікна та віджету введення
window = tk.Tk()
window.title('Моніторинг світла')


window_width = 400
window_height = 150


# get the screen dimension
screen_width = window.winfo_screenwidth()
screen_height = window.winfo_screenheight()

# find the center point
center_x = int(screen_width/2 - window_width / 2)
center_y = int(screen_height/2 - window_height / 2)

# set the position of the window to the center of the screen
window.geometry(f'{window_width}x{window_height}+{center_x}+{center_y}')

ping = ttk.Frame(window)
ping.pack(padx=10, pady=10, fill='x', expand=True)
# Створення мітки для запиту ID користувача
label = ttk.Label(ping,text="Введіть ваше посилання для API:")
label.pack(fill='x', expand=True)
# Створення віджету введення для введення ID
entry = ttk.Entry(ping)
entry.pack(fill='x', expand=True)
entry.focus()
# Створення мітки для відображення статусу
status_label = ttk.Label(ping,text="")
status_label.pack(fill='x', expand=True, pady=10)

# Створення кнопки для запуску процесу оновлення
button = ttk.Button(ping,text="Зберегти", command=update_request)
button.pack(fill='x', expand=True, pady=10)

# Запуск першого оновлення (безпечний доступ у головному потоці)
update_request()

# Запуск циклу обробки подій для Tkinter GUI

photo = tk.PhotoImage(file = 'C:\OSPanel\domains\py.t\svitlo.png')
window.wm_iconphoto(False, photo)
window.mainloop()

