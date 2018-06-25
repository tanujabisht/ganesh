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
    class ClinicsTable extends Table {

        /**
         * Initialize method
         *
         * @param array $config The configuration for the Table.
         * @return void
         */
        public function initialize(array $config) {
            parent::initialize($config);  

            $this->addBehavior('Timestamp');
           
        }
        
        
        public function validationDefault(Validator $validator) {
            $validator
                    ->integer('id')
                    ->allowEmpty('id', 'create');

            $validator
                    ->requirePresence('name', 'create', "Please enter name")
                    ->notEmpty('name', "Please enter name");
                    
            $validator
                    ->requirePresence('password', 'create', "Please enter Password")
                    ->notEmpty('name', "Please enter Password");
            
            return $validator;
        }

        public function buildRules(RulesChecker $rules) {         
            $rules->add($rules->isUnique(['phone'], "Phone Number  already exists"));

            return $rules;
        }
        
        
    }
    
    
    