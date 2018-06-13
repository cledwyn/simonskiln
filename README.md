# simonskiln

UI page for the Data Logger project.  I will have the data up soonish about the parts there were used.

## Particle.io code
[pyrologger.ino](pyrologger.ino)

## To make this website

 * Install Composer for PHP (just 'cuz I'm lazy and firebase libraries make it easier)  Dont really need for consumption front end.
 * composer install
 * should be good.  Firebase will read from anywhere.

## Setup the Particle WEBHOOK
In your particle.io config section.  Add a webhook to point to your [pyrologger.php](pyrologger.php) endpoint.
similar to this:

![settings](https://github.com/lloydlentz/simonskiln/raw/master/img/particle-webhook-settings.png)
