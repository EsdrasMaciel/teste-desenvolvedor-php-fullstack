
# Teste Full Stack StartGov

Teste para dev Full Stack na empresa StartGov

## Frontend

Acesse a pasta do Frontend
```bash
cd Frontend/
```

Instalar os modulos
```bash
npm install
```
Iniciar a aplicação
```bash
npm run dev 
```

## Backend

Acesse a pasta do backend
```bash
cd backend/
```
Crie o .env do projeto
```bash
cp .env.example .env
```
Suba os containers do projeto
```bash
docker-compose up -d
```
Acesse o container app
```bash
docker-compose exec app bash
```
Instale as dependências do projeto
```bash
composer install
```
Gere a key do projeto Laravel
```bash
php artisan key:generate
```
Rodar as migrations
```bash
php artisan migrate
```


## Apêndice

Coloque qualquer informação adicional aqui


## Documentação

 - [Documentação da Api via Postman](https://documenter.getpostman.com/view/2871502/2sA3kXFLaW)


## Documentação da API

#### Retorna todos os fornecedores

```http
  GET http://localhost:8010/api/fornecedor
```
| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
|    |        |                                    |

   + Body

            {
 
            }

+ Response 200 (application/json)

    + Body

          [
            {
                        "id": "id",
                        "razao_social": "Razão Social empresa",
                        "nome_fantasia": "Nome fantasia",
                        "cpf_cnpj": "CNPJ OU CPF",
                        "telefone": "(00)00000-0000",
                        "email": "email@email.com",
                        "endereco": "Logradouro",
                        "numero": "Numero do endereco",
                        "bairro": "Um Bairro",
                        "cidade": "Uma cidade",
                        "estado": "MA",
                        "created_at": "",
                        "updated_at": "",
                        "deleted_at": null
            }
          ]

#### Retorna um fornecedor

```http
  GET http://localhost:8010/api/fornecedor/{{id}}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `int` | **Obrigatório**. O ID do fornecedor |

   + Body

            {
            }

+ Response 200 (application/json)

    + Body

          {
                        "id": id,
                        "razao_social": "Razão Social empresa",
                        "nome_fantasia": "Nome fantasia",
                        "cpf_cnpj": "CNPJ OU CPF",
                        "telefone": "(00)00000-0000",
                        "email": "email@email.com",
                        "endereco": "Logradouro",
                        "numero": "Numero do endereco",
                        "bairro": "Um Bairro",
                        "cidade": "Uma cidade",
                        "estado": "MA",
                        "created_at": "",
                        "updated_at": "",
                        "deleted_at": null
          }


#### Criar um fornecedor

```http
  POST http://localhost:8010/api/fornecedor/create
```    
| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
|    |        |                                    |

    + Body

            {
                   "cpf_cnpj": "CNPJ OU CPF",
                    "email": "Email Valido",
                    "nome_fantasia": "Nome fantasia",
                    "razao_social": "Razão Social empresa",
                    "telefone": "(00)00000-0000 ",
                    "endereco": "Logradouro",
                    "numero": "Numero do endereco",
                    "bairro": "Um Bairro",
                    "cidade": "Uma cidade",
                    "estado": "Sigla"   
            }

+ Response 200 (application/json)

    + Body

          {
                    "cpf_cnpj": "CNPJ OU CPF",
                    "email": "Email Valido",
                    "nome_fantasia": "Nome fantasia",
                    "razao_social": "Razão Social empresa",
                    "telefone": "(00)00000-0000 ",
                    "endereco": "Logradouro",
                    "numero": "Numero do endereco",
                    "bairro": "Um Bairro",
                    "cidade": "Uma cidade",
                    "estado": "Sigla"   
          }


#### Atualizar um fornecedor

```http
  PUT http://localhost:8010/api/fornecedor/update/{{id}}
```  

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `int` | **Obrigatório**. O ID do fornecedor que você deseja atualizar |

    + Body

            {
                   "cpf_cnpj": "CNPJ OU CPF",
                    "email": "Email Valido",
                    "nome_fantasia": "Nome fantasia",
                    "razao_social": "Razão Social empresa",
                    "telefone": "(00)00000-0000 ",
                    "endereco": "Logradouro",
                    "numero": "Numero do endereco",
                    "bairro": "Um Bairro",
                    "cidade": "Uma cidade",
                    "estado": "Sigla"   
            }

+ Response 200 (application/json)

    + Body

          {
                    "cpf_cnpj": "CNPJ OU CPF",
                    "email": "Email Valido",
                    "nome_fantasia": "Nome fantasia",
                    "razao_social": "Razão Social empresa",
                    "telefone": "(00)00000-0000 ",
                    "endereco": "Logradouro",
                    "numero": "Numero do endereco",
                    "bairro": "Um Bairro",
                    "cidade": "Uma cidade",
                    "estado": "Sigla"   
          }


#### Deletar um fornecedor

```http
  DELETE http://localhost:8010/api/fornecedor/update/{{id}}
```  

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `int` | **Obrigatório**. O ID do fornecedor que você deseja deletar |

    + Body

            {      
            }

+ Response 200 (application/json)

    + Body

          {
              "status": "Deletado"            
          }
