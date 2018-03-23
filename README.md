# TalentLMS-API
TalentLMS API PHP Library

Add to the composer.json file the below repository and require section to install the library

```javascript
  {
    "require": {
      "easy-forex/talentlms-api": "dev-master"
    },
    "repositories": [
    	{
    	  "type": "git",
    	  "url": "https://github.com/Easy-Forex/TalentLMS-API.git"
    	}
      ],
      "minimum-stability": "dev",
      "prefer-stable": true   
  }
```

To use the library on the project, add the use statement and call the static functions

```php
<?php
use TalentLMS\TalentLMS;

class LearnManagement {
    public function __construct()
    	{
    		TalentLMS::setApiKey("API_KEY");
    		TalentLMS::setDomain("API_HOST");
    	}
}
?>
```