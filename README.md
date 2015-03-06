Wwwision.Neos.Vendors
=====================

TYPO3 Neos plugin demonstrating a simple way to mirror (FE user managed) entities in the TYPO3CR  

DISCLAIMER:
-----------

This package is for testing & demonstration purposes only!

How-To:
-------

* This package requires ``Wwwision.Neos.FrontendLogin`` (https://github.com/bwaidelich/Wwwision.Neos.FrontendLogin) and
``TYPO3.NeosDemoTypo3Org`` (https://git.typo3.org/Packages/NeosDemoTypo3Org.git) - install those first if not done
already
 
* Install the package to ``Packages/Plugin/Wwwision.Neos.Vendors``
  (e.g. via ``composer require wwwision/neos-vendors:dev-master``)
* Run database migrations: ``./flow doctrine:migrate``
* Login to the TYPO3 Neos backend and create a new page "My Vendors" (e.g. at ``/members/my-vendors``)
* On that page insert the new plugin ``Vendor management``
* Create a page "Vendors" (e.g. at ``/vendors``) that will contain the public listing of vendors
* Publish all changes

Now, if you login as FE user, navigate to ``/en/members/my-vendors.html`` and create a new vendor this should create a
new public "vendor page" under ``/en/vendors/<vendor-name>.html``.