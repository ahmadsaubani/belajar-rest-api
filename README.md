# Read Me || Test Dana Laut

Assalamualaikum mas arif .
mohon maaf sebelum nya saya tidak dapat menyelesaikan yang di perintahkan mas arif seperti yang di PDF, membuat backend dan front end,
tapi jangan kecewa dulu mas hehe .. saya coba buat REST API symfony 4 semampu saya, dicoba test dulu ya mas rest api nya.. siapa tau jadi bahan pertimbangan nanti .
walaupun cuma sekedar endpoint nya saja .. yang belum di consume di frontend ..
Berikut fitur yang tersedia :

* Login
* Register  {POST}
* Supplier  {GET,PATCH,DELETE}
* Customer  {GET,PATCH}
* Product   {GET,POST,PATCH,DELETE}
* insya allah semua validasi tidak di client side



How to run :

    NOTE :
         Mohon maaf mas sebelumnya, bukan maksut ingin menggurui mas , tapi saya ingin menjelaskan lebih detail . sekali lagi mohon maaf mas
* composer install
* coba di cek di bagian config/jwt/ , apakah ada private.pem dan public.pem ?.

    jika belum ada coba copy ini mas ke console terminal
    
        $ openssl genrsa -out config/jwt/private.pem -aes256 4096
        
        $ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
    
        tujuan nya untuk apa ? .. untuk generate SSH Key. lebih lengkap nya bisa di cek disini https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#configuration

* setelah itu coba di cek .env , apakah sudah ter setting dengan baik ? jikalau sudah lets goww mas
* php bin/console server:run atau bisa jg bin/console server:run

    dicoba akses localhost:8000/docs
    jikalau berjalan dengan lancar tandanya tinggal register Customer / Supplier 
    setelah itu login_check , dari login tsb kita mendapatkan token .
    token itu di gunakan di Authorization dengan Value "Bearer eyJ0eXAiOiJK.......dst"
    
* oh iya saya lupa untuk reload database bisa langsung lewat console " bin/reload-database "
* jikalau ada yang kurang jelas . mohon contact saya ya mas hehe whatsapp : +6289648220133 .

Bundle yang saya gunakan di project ini :
            
            Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
            Symfony\Bundle\WebServerBundle\WebServerBundle::class => ['dev' => true],
            Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle::class => ['all' => true],
            Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
            Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
            Symfony\Bundle\MakerBundle\MakerBundle::class => ['dev' => true],
            Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
            Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
            FOS\UserBundle\FOSUserBundle::class => ['all' => true],
            Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle::class => ['all' => true],
            Liip\FunctionalTestBundle\LiipFunctionalTestBundle::class => ['dev' => true, 'test' => true],
            Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],
            Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle::class => ['dev' => true, 'test' => true],
            Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle::class => ['all' => true],
            Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
            Nelmio\ApiDocBundle\NelmioApiDocBundle::class => ['all' => true],
            FOS\RestBundle\FOSRestBundle::class => ['all' => true],
            Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle::class => ['all' => true],
            Vich\UploaderBundle\VichUploaderBundle::class => ['all' => true],
            Oneup\FlysystemBundle\OneupFlysystemBundle::class => ['all' => true],
            Liip\ImagineBundle\LiipImagineBundle::class => ['all' => true],