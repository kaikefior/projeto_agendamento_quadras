# Ambiente local no Windows

Ambiente preparado com PHP 8.4.5, Composer 2.10.2 e Node.js 22.21.1.
O arquivo .env usa SQLite em database/database.sqlite. A chave da aplicacao e as migracoes ja foram configuradas.

## Iniciar

Abra um terminal nesta pasta:

```powershell
php artisan serve
```

Acesse http://localhost:8000. Para atualizar CSS e JavaScript durante o desenvolvimento, abra outro terminal nesta pasta:

```powershell
npm.cmd run dev
```

Se precisar processar tarefas da fila, use outro terminal:

```powershell
php artisan queue:work
```

## Verificar

```powershell
php artisan test
npm.cmd run build
composer check-platform-reqs
```

## Instalar dependencias novamente

Foi necessario usar os certificados confiaveis do Windows para o Composer nesta maquina. O arquivo local storage/windows-ca.pem esta excluido do Git.

```powershell
$env:COMPOSER_CAFILE = Join-Path (Get-Location) 'storage\windows-ca.pem'
composer install
npm.cmd ci
```

O npm informou 4 vulnerabilidades nas dependencias (2 altas e 2 criticas). As versoes dos arquivos de lock foram preservadas; revise com npm.cmd audit antes de atualizar.
