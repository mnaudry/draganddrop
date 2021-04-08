# draganddrop

### Customize configuration config/app.ini
```

file  "your dir"/config/app.ini

server = "your mysql server"
user = "your user"
pwd = "your password"
[db]
db = "name of your database"
[table]
table = "name of your table"
[nb_items]
items = 10 "number of items to create"

PS : App will create database, table and it will insert some fixtures  with number specify in items.
