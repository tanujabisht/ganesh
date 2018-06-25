<?php

    namespace App\Model\Table;

    use Cake\ORM\Query;
    use Cake\ORM\RulesChecker;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;

    /**
     * Users Model
     *
     *
     * @mixin \Cake\ORM\Behavior\TimestampBehavior
     */
    class VediosTable extends Table {

        /**
         * Initialize method
         *
         * @param array $config The configuration for the Table.
         * @return void
         */
        public function initialize(array $config) {
            parent::initialize($config);
            $this->addBehavior('Timestamp');
             $this->belongsTo('Cats', [
                'foreignKey' => 'category_id',
                'joinType' => 'LEFT'
            ]);
        }

       
    }
    
    
    