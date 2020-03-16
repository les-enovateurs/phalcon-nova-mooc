
<h1 align="center">
  <br>
  <a href="https://les-enovateurs.com"><img src="https://user-images.githubusercontent.com/3491729/76463694-2274e180-63e4-11ea-9a05-442d00de2fed.png" alt="Nova Mooc - Phalcon - PHP Example" width="72"></a>
  <br>
NovaMooc - a Phalcon project
  <br>
</h1>

<h4 align="center">A Mooc project developed with <a href="https://github.com/phalcon/cphalcon" target="_blank">Phalcon</a>, a <a href="https://www.php.net/" target="_blank">PHP</a> framework.</h4>

<p align="center">
<a href="https://www.buymeacoffee.com/enovateurs" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/default-violet.png" height="41px" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" ></a>
</p>

<p align="center">
  ![Integrations tests](https://github.com/les-enovateurs/phalcon-nova-mooc/workflows/Integrations%20tests/badge.svg)
</p>

<p align="center">
  <a href="#key-features">Key Features</a> •
  <a href="#how-to-use">How To Use</a> •
  <a href="#contributing">Contributing</a> •
  <a href="#credits">Credits</a> •
  <a href="#license">License</a>
</p>


## Key Features

* A MOOC project (create courses, add students...)
* Architecture with Api/Web
* Handle token with JWT
* Use Docker-compose to build this project
* Cross platform :
  - Windows, macOS and Linux ready.

## How To Use

To clone and run this application, you'll need [Git](https://git-scm.com) and [Docker](https://www.docker.com/) installed on your computer. From your command line :

```bash
# Clone this repository
$ git clone https://github.com/les-enovateurs/phalcon-nova-mooc

# Go into the repository
$ cd phalcon-nova-mooc

# Create or recreate API/Web services
$ ./1a-create_launch_services.sh

# Restart services without loosing the data
$ ./1b-restart_services.sh

# Stop services
$ ./2-stop.sh
```
Then open a browser and go to this link : [http://localhost/](http://localhost/).


Note : if you want to know more about the code and how it works : 
- You can analyse the (few) files

## Contributing

We are interested in implementing new features, such as creating students accounts, adding courses...
We'd also like to help teachers add all the content of their courses.

## Credits

This software uses the following open source packages:

- [Phalcon](https://github.com/phalcon/cphalcon)
- [Docker](https://www.docker.com/)
- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [JWT](https://github.com/lcobucci/jwt)
- [Guzzle](https://github.com/guzzle/guzzle)

## You may also like...

- [MailHog Examples](https://github.com/les-enovateurs/mailhog-examples) - Try Mailhog with Docker and different languages.

- [Livre Phalcon](https://github.com/les-enovateurs/livre-phalcon) - Numerous examples showing how to use Phalcon PHP Framework.

## License

GPL-3.0

---

> [Les-Enovateurs.com](https://les-enovateurs.com/) &nbsp;&middot;&nbsp;
> GitHub [@jenovateurs](https://github.com/jenovateurs) &nbsp;&middot;&nbsp;
> Twitter [@LesEnovateurs](https://twitter.com/LesEnovateurs)

