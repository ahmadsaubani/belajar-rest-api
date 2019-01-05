## Instalasi


### Generate JWT Key

```bash
mkdir -p config/jwt
openssl genrsa -out storage/private.pem -aes256 4096
openssl rsa -pubout -in storage/private.pem -out storage/public.pem
```
> Passpharse: `develop`

### Install Dependency
```bash
composer install
```