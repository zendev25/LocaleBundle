<?php

namespace ZEN\LocaleBundle\Entity\Translation;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;
use Gedmo\Translatable\TranslatableListener;

//use Gedmo\Translatable\Entity\Repository\TranslationRepository;

/**
 * Class TranslatableRepository
 *
 * This is my translatable repository that offers methods to retrieve results with translations
 */
class TranslatableRepository extends EntityRepository {

    private $sql;
    private $queryParams;
    protected $user;
    

    /**
     * @var string Default locale
     */
    protected $defaultLocale;

    /**
     * Sets default locale
     *
     * @param string $locale
     */
    public function setDefaultLocale($locale) {
        $this->defaultLocale = $locale;
    }

    public function setUser($user) {
        $this->user = $user;
    }
    
    //Pour les form, type 'entity'
    public function myFindAll($statusTrans = true) {
        $qb = $this->createQueryBuilder('e');
        if ($statusTrans) {
            $qb->where('e.statusTrans=:statusTrans')
                    ->setParameter('statusTrans', $statusTrans);
        }

        return $qb;
    }

    public function findAll($locale = null, $statusTrans = true) {
        $qb = $this->createQueryBuilder('e');
        if ($statusTrans) {
            $qb->where('e.statusTrans=:statusTrans')
                    ->setParameter('statusTrans', $statusTrans);
        }

        return $this->getResult($qb, $locale);
    }

    public function find($id, $locale = null, $statusTrans = true) {
        $qb = $this->createQueryBuilder('e');
        $qb->where('e.id=:id')
                ->setParameter('id', $id);

        if ($statusTrans) {
            $qb->andWhere('e.statusTrans = :statusTrans')
                    ->setParameter('statusTrans', $statusTrans);
        }

        return $this->getSingleResult($qb, $locale);
    }

    public function findAllForForm() {
        $qb = $this->createQueryBuilder('e');
        $this->getTranslatedQuery($qb);

        return $qb;
    }

    /**
     * Returns translated one (or null if not found) result for given locale
     *
     * @param QueryBuilder $qb            A Doctrine query builder instance
     * @param string       $locale        A locale name
     * @param string       $hydrationMode A Doctrine results hydration mode
     *
     * @return QueryBuilder
     */
    public function getOneOrNullResult(QueryBuilder $qb, $locale = null, $hydrationMode = null) {

        return $this->getTranslatedQuery($qb, $locale)->getOneOrNullResult($hydrationMode);
    }

    /**
     * Returns translated results for given locale
     *
     * @param QueryBuilder $qb            A Doctrine query builder instance
     * @param string       $locale        A locale name
     * @param string       $hydrationMode A Doctrine results hydration mode
     *
     * @return QueryBuilder
     */
    public function getResult(QueryBuilder $qb, $locale = null, $hydrationMode = AbstractQuery::HYDRATE_OBJECT) {
        return $this->getTranslatedQuery($qb, $locale)->getResult($hydrationMode);
    }

    /**
     * Returns translated array results for given locale
     *
     * @param QueryBuilder $qb     A Doctrine query builder instance
     * @param string       $locale A locale name
     *
     * @return QueryBuilder
     */
    public function getArrayResult(QueryBuilder $qb, $locale = null) {
        return $this->getTranslatedQuery($qb, $locale)->getArrayResult();
    }

    /**
     * Returns translated single result for given locale
     *
     * @param QueryBuilder $qb            A Doctrine query builder instance
     * @param string       $locale        A locale name
     * @param string       $hydrationMode A Doctrine results hydration mode
     *
     * @return QueryBuilder
     */
    public function getSingleResult(QueryBuilder $qb, $locale = null, $hydrationMode = null) {
        return $this->getTranslatedQuery($qb, $locale)->getSingleResult($hydrationMode);
    }

//    public function getOneOrNullResult(QueryBuilder $qb, $locale = null, $hydrationMode = null)
//    {
//        return $this->getTranslatedQuery($qb, $locale)->getOneOrNullResult($hydrationMode);
//    }

    /**
     * Returns translated scalar result for given locale
     *
     * @param QueryBuilder $qb     A Doctrine query builder instance
     * @param string       $locale A locale name
     *
     * @return QueryBuilder
     */
    public function getScalarResult(QueryBuilder $qb, $locale = null) {
        return $this->getTranslatedQuery($qb, $locale)->getScalarResult();
    }

    /**
     * Returns translated single scalar result for given locale
     *
     * @param QueryBuilder $qb     A Doctrine query builder instance
     * @param string       $locale A locale name
     *
     * @return QueryBuilder
     */
    public function getSingleScalarResult(QueryBuilder $qb, $locale = null) {
        return $this->getTranslatedQuery($qb, $locale)->getSingleScalarResult();
    }

    /**
     * Returns translated Doctrine query instance
     *
     * @param QueryBuilder $qb     A Doctrine query builder instance
     * @param string       $locale A locale name
     *
     * @return Query
     */
    protected function getTranslatedQuery(QueryBuilder $qb, $locale = null) {
//        $qb = $this->draftizeQueryBuilder($qb);

        $locale = null === $locale ? $this->defaultLocale : $locale;


        $query = $qb->getQuery();

        $query->setHint(
                Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        $query->setHint(TranslatableListener::HINT_TRANSLATABLE_LOCALE, $locale);
        $this->sql = $query->getSQL();

        $this->queryParams = $query->getParameters();
        return $query;
    }

    public function getQueryParams() {
        return $this->queryParams;
    }

    public function getSql() {
        return $this->sql;
    }

}
