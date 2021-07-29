
# NOVA TENTATIVA DE CONFIGURAÇÃO

## Acessar a conta AWS

''' sh
$ aws configure
'''

#### User -> AKIA4A3V2HUFWA377SOH
#### Key -> nhsMS640HDVl6lbsi3r9vG8x468Gy68dvqupoUFG
#### Zone -> us-east-1
#### Format -> json

## Criar a VPC via CloudFormation

	https://s3.us-west-2.amazonaws.com/amazon-eks/cloudformation/2020-10-29/amazon-eks-vpc-sample.yaml

## Criar o cluster usando awscli 

''' sh
$ aws eks create-cluster --name prod --role-arn arn:aws:iam::826491419915:role/RoleEKS --resources-vpc-config subnetIds=subnet-0857c7b429aa72353,subnet-03e4ab1cd04e09d28,subnet-018dac3e514c15b1c,securityGroupIds=sg-093eb50d23709558b
'''

''' sh
$ aws eks list-clusters

$ aws eks describe-cluster --name prod

'''

## Conectar o kubectl local com o cluster EKS

	Quando o cluster estiver ativo:

''' sh
$ aws eks update-kubeconfig --region us-east-1 --name prod

$ kubectl get svc

$ kubectl version
'''

## Criação dos nodes no EC2 via CloudFormation

### Documentação do nodegroup formation 
-> https://docs.aws.amazon.com/eks/latest/userguide/eks-optimized-ami.html

### Modelo

	https://s3.us-west-2.amazonaws.com/amazon-eks/cloudformation/2020-10-29/amazon-eks-nodegroup.yaml

Inserir dependendo da versão do kubernetes.
	/aws/service/eks/optimized-ami/1.20/amazon-linux-2/recommended/image_id
	/aws/service/eks/optimized-ami/1.21/amazon-linux-2/recommended/image_id

## Conectar (join) os nodes ECS ao cluster EKS

''' sh
$ curl -o aws-auth-cm.yaml https://s3.us-west-2.amazonaws.com/amazon-eks/cloudformation/2020-10-29/aws-auth-cm.yaml
'''

Inserir no arquivo aws-auth-cm.yaml que foi baixado o código do NodeInstanceRole criado nos nodes de EKS via CloudFormation
	arn:aws:iam::826491419915:role/nodes-eks-NodeInstanceRole-7ZBOYILFKLU2

''' sh
$ kubectl apply -f aws-auth-cm.yaml

$ kubectl get nodes --watch
'''

## Kubernetes dashboard

### Documentação de instalação do Kubernetes Dashboard
-> https://kubernetes.io/docs/tasks/access-application-cluster/web-ui-dashboard/

Instalação do dashboard

''' sh
$ kubectl apply -f https://raw.githubusercontent.com/kubernetes/dashboard/v2.2.0/aio/deploy/recommended.yaml
'''

Após a instalação, é necessário criar uma conta de serviço, seguindo o link:
https://github.com/kubernetes/dashboard/blob/master/docs/user/access-control/creating-sample-user.md

Criar os dois arquivos: ServiceAccount e o ClusterRoleBinding

Após, acessar o token de usuário

''' sh
$ kubectl -n kubernetes-dashboard get secret $(kubectl -n kubernetes-dashboard get sa/admin-user -o jsonpath="{.secrets[0].name}") -o go-template="{{.data.token | base64decode}}"
'''

Subir o proxy em outro terminal, para não bloquear o local.
''' sh
$ kubectl proxy
'''

Com o proxy funcionando, acessar o dashboard pelo link
-> http://localhost:8001/api/v1/namespaces/kubernetes-dashboard/services/https:kubernetes-dashboard:/proxy/.

Usando o token, abrir um proxy. Isso bloqueia o terminal

# Anterior

## Instalação KUBECTL

''' sh
$ curl -LO https://storage.googleapis.com/kubernetes-release/release/$(curl -s https://storage.googleapis.com/kubernetes-release/release/stable.txt)/bin/linux/amd64/kubectl

$ chmod +x ./kubectl

$ sudo mv ./kubectl /usr/local/bin/
'''

## Instalação DOCKER

''' sh
$ sudo apt-get update

$ sudo apt-get install docker.io -y
'''

## Instalação MINIKUBE

''' sh
$ curl -Lo minikube https://storage.googleapis.com/minikube/releases/v0.32.0/minikube-linux-amd64 && chmod +x minikube && sudo cp minikube /usr/local/bin/ && rm minikube
'''

### (EXECUTAR COMO ROOT)

''' sh
$ minikube start --vm-driver=none
'''

## Acertando as permissões para o Usuário

''' sh
$ sudo mv /root/.kube $HOME/.kube
$ sudo chown -R $USER $HOME/.kube
$ sudo chgrp -R $USER $HOME/.kube
$ sudo mv /root/.minikube $HOME/.minikube
$ sudo chown -R $USER $HOME/.minikube
$ sudo chgrp -R $USER $HOME/.minikube
'''

