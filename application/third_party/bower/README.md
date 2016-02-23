# Bower
Bower for Codeigniter 3

## Requirements

- PHP 5.4.x (Composer requirement)
- CodeIgniter 3.0.x

## Installation
### Step 1 Installation by Composer
#### Run composer
```shell
composer require maltyxx/bower
```
### Step 2 Configuration
Edit file `./application/config/config.php` set `$config['composer_autoload'] = FALSE;` to `$config['composer_autoload'] = FCPATH.'vendor/autoload.php';`

Duplicate configuration file `./application/third_party/origami/config/bower.php` in `./application/config/bower.php`.

### Step 3 Examples
Bower file is located in `/bowerci.json`.
```json
{
    "ci": {
        "css": {
             "build/default.min.css": [
                "bower_components/angular/angular-csp.css"
            ]
        },
        "js": {
            "build/default.min.js": [
                "bower_components/jquery/dist/jquery.js",
                "bower_components/angular/angular.js"
            ]
        }
    }
}
```

Controller file is located in `/application/controllers/Exemple.php`.
```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exemple extends CI_Controller {

	public function index()
	{
		$this->load->add_package_path(APPPATH.'third_party/bower');
        $this->load->library('bower');
        $this->load->remove_package_path(APPPATH.'third_party/bower');

        $this->load->view('exemple_index', [
            'css' => $this->bower->css('default'),
            'js' => $this->bower->js('default')
        ]);
	}

    public function form()
	{
		$this->load->add_package_path(APPPATH.'third_party/bower');
        $this->load->library('bower');
        $this->load->remove_package_path(APPPATH.'third_party/bower');

        $css = $this->bower->css('default');
        $css[] = $this->bower->add(base_url('assets/js/form.js'));
        $css[] = $this->bower->add('https://maps.googleapis.com/maps/api/js');

        $this->load->view('exemple_index', [
            'css' => $css,
            'js' => $this->bower->js('default')
        ]);
	}

}
```

View file is located in `/application/views/exemple_index.php`.
```php
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <?php foreach ($css as $file) { ?>
    <link href="<?php echo $file['src']; ?>" media="all" rel="stylesheet" />
    <?php } ?>
</head>
<body>
    <?php foreach ($js as $file) { ?>
     <script src="<?php echo $file['src']; ?>"></script>
    <?php } ?>
</body>
</html>
```

### Step 4 Compilation with Grunt
This plugin requires Grunt >=0.4.0

If you haven't used Grunt before, be sure to check out the Getting Started guide, as it explains how to create a Gruntfile as well as install and use Grunt plugins. Once you're familiar with that process, you may install this plugin with this command:

```
npm install grunt-contrib-cssmin --save
npm install grunt-contrib-uglify --save
```

Grunt file is located in `/Gruntfile.js`.

```js
module.exports = function(grunt) {
    
    grunt.initConfig({
        
        bower: grunt.file.readJSON("bowerci.json"),
        
        cssmin: {
            options: {
                rebase: true,
                report: "min",
                sourceMap: false
            },
            target: {
                files: "<%= bower.ci.css %>"
            }
        },
        
        uglify: {
            target: {
                files: "<%= bower.ci.js %>"
            }
        }

    });
    
    grunt.loadNpmTasks("grunt-contrib-cssmin");
    grunt.loadNpmTasks("grunt-contrib-uglify");
    
    grunt.registerTask("build", ["cssmin", "uglify"]);
};
```

Run compilation `grunt build` and change `'build' => TRUE` in `./application/config/config.php`.
