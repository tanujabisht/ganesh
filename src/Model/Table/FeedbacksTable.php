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
    class FeedbacksTable extends Table {

        /**
         * Initialize method
         *
         * @param array $config The configuration for the Table.
         * @return void
         */
        public function initialize(array $config) {
            parent::initialize($config);
            $this->addBehavior('Timestamp');
             $this->belongsTo('Users', [
                'foreignKey' => 'user_id',
                'joinType' => 'LEFT'
            ]);
        }

       
    }
    
    
    