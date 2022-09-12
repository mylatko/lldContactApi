<?php

namespace App\Service\Contact\Repository;

use App\Service\Contact\DTO\SaveContactDTO;
use App\Service\Contact\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contact>
 *
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    public function store(SaveContactDTO $dto, ?string $imageLink)
    {
        $contact = new Contact();
        $contact->setFirstName($dto->getFirstName());
        $contact->setLastName($dto->getLastName());
        $contact->setAddress($dto->getAddress());
        $contact->setPhone($dto->getPhone());
        $contact->setBirthday($dto->getLastName());
        $contact->setEmail($dto->getEmail());
        if (null !== $imageLink) {
            $contact->setPicture($imageLink);
        }

        $this->add($contact, 1);
    }

    public function findByName(string $name): array
    {
        //@todo think about max results
        return $this->createQueryBuilder('c')
            ->where('LOWER(c.first_name) LIKE :val')
            ->orWhere('LOWER(c.last_name) LIKE :val')
            ->orWhere('LOWER(CONCAT(c.first_name, \' \', c.last_name)) LIKE :val')
            ->setParameter('val', '%' . strtolower($name) . '%')
            ->setMaxResults($_ENV['GET_CONTACT_LIMIT'])
            ->getQuery()
            ->getResult()
        ;
    }

    public function add(Contact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Contact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AppServiceContactEntityContact[] Returns an array of AppServiceContactEntityContact objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AppServiceContactEntityContact
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
