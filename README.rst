Q and A сайтын тохируулга
====
#. `app/config/parameters.yml` Файлд өөрийн database -ийн тохиргоог бичиж өгнө.

#. `app/cache`, `app.logs` гэсэн хавтасуудад бүрэн эрх өгнө::

    sudo chmod 777 app/cache app/logs

#. Хийгдсэн байх тохиргоонууд::

    - htaccess:
      cp htaccess.def web/.htaccess
      .htaccess файл DOCUMENT_ROOT болон HTTP_HOST - ыг тохируулж өгнө.

    - apache-server:
      cp qanda.local.def /etc/apache2/sites-available/qanda.local
      qanda.local - ыг тохируулж өгнө.
      a2ensite qanda.local
      a2enmod rewrite.  
