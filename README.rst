Q and A сайтын тохируулга
====
#. `app/config/parameters.yml` Файлд өөрийн database -ийн тохиргоог бичиж өгнө.

Хийгдсэн байх тохиргоонууд
====
#. `app/cache`, `app.logs` гэсэн хавтасуудад бүрэн эрх өгнө::

    sudo chmod 777 app/cache app/logs

#. /etc/hosts - дээр host нэмэх::

    echo "127.0.0.1 qanda.dev" | sudo tee -a/etc/hosts
    
#. apache-server - дээр qanda.local virtualhost тохируулах::

    sudo cp qanda.local.def /etc/apache2/sites-available/qanda.local
    sudo a2ensite qanda.local
    sudo a2enmod rewrite
    sudo service apache2 restart

#. CSS, Javascript гэх мэт static файлууд дээр өөрчлөлт орсоны дараа `web`
   дотор тэдгээрийг үүсгэж өгнө::

    app/console assetic:dump
