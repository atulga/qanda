Q and A сайтын тохируулга
====
#. `app/config/parameters.yml` Файлд өөрийн database -ийн тохиргоог бичиж өгнө.

Хийгдсэн байх тохиргоонууд
====
#. /etc/hosts - дээр host нэмэх:

    echo "127.0.0.1 qanda.dev" | sudo tee -a/etc/hosts

#. apache-server - дээр qanda.local virtualhost тохируулах:

    sudo cp qanda.local.def /etc/apache2/sites-available/qanda.local
    sudo a2ensite qanda.local
    sudo a2enmod rewrite
    sudo service apache2 restart
