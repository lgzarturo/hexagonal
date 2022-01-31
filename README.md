# Hexagonal MVC Micro Framework

Provee una estructura simple, poderosa y flexible para crear aplicaciones web.

El objetivo es crear un Framework solo con el lenguaje PHP, que se pueda usar en cualquier proyecto.

Define la base de carpetas y archivos para una aplicación web.

Tecnologías:

- MAMP 5
- PHP 8.1.0
- Apache 2
- MySQL 5.7.24

## Configuración de la aplicación

Crear el archivo .env con las siguientes variables:

'''properties
TIMEZONE=America/Cancun
LANGUAGE=es
APP_SALT=HexagonalFramework
DB_ENGINE=mysql
DB_HOST={{ database_host }}
DB_PORT={{ database_port }}
DB_NAME={{ database_name }}
DB_USER={{ database_user }}
DB_PASS={{ database_password }}
DB_CHARSET=utf8
DB_COLLATION=utf8_general_ci
'''

>> Plantilla de ejemplo: .envSample
