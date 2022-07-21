<script>
    var Forms = function(){
        let me = Ext.utils.windowForms(this);

        me.init = function(){
            me.form = Ext.widget('form', {
                bodyPadding: 10,
                flex: 1,
                autoHeight: true,
                border: false,
                autoScroll: true,
                defaultType: 'textfield',
                layout: {type: 'vbox', align: 'stretch'},
                submitEmptyText: false,
                fieldDefaults:{labelAlign: 'top', allowBlank: false},
                items : [
                    {xtype: 'hidden', name: '_token', value: '{{ csrf_token() }}'},
                    {
                        xtype: 'fieldcontainer', autoHeight: true,
                        layout: {type: 'hbox', align: 'stretch'},
                        fieldDefaults: { margin: 5 },
                        items: [
                            {xtype: 'textfield', name: 'username', fieldLabel: 'User Name', flex: 1},
                            {xtype: 'textfield', inputType: 'password', name: 'password', fieldLabel: 'Password', flex: 1},
                            {
                                xtype: 'combo', name: 'role_id', fieldLabel: 'Role', flex: 1,
                                forceSelection: true, editable: false, queryMode: 'local', triggerAction: 'all',
                                displayField: 'name', valueField: 'id',
                                store: Ext.create('Ext.data.Store', {
                                    fields: [
                                        {name: 'id', type: 'int'},
                                        {name: 'name', type: 'string'},
                                        {name: 'properties', type: 'auto'},
                                    ],
                                    data: roles
                                }),
                                listeners: {
                                    select: function (obj, rec) {
                                        me.onSelectRole(rec);
                                    },

                                }
                            },
                        ]
                    },

                    {
                        xtype: 'fieldcontainer', autoHeight: true,
                        layout: {type: 'hbox', align: 'stretch'},
                        fieldDefaults: {margin: 5},
                        items: [
                            {
                                xtype: 'combo', name: 'activities[]', fieldLabel: 'Activities', flex: 1, hidden: true,
                                forceSelection: true, editable: false, queryMode: 'local', triggerAction: 'all',
                                displayField: 'alias', valueField: 'id', allowBlank: true, multiSelect: true,
                                store: Ext.create('Ext.data.Store', {
                                    fields: [
                                        {name: 'id', type: 'int'},
                                        {name: 'alias', type: 'string'},
                                    ],
                                    data: activities
                                }),
                            },

                            {
                                xtype: 'combo', name: 'owners[]', fieldLabel: 'Owners', flex: 1, hidden: true,
                                forceSelection: true, editable: false, queryMode: 'local', triggerAction: 'all',
                                displayField: 'alias', valueField: 'id', allowBlank: true, multiSelect: true,
                                store: Ext.create('Ext.data.Store', {
                                    fields: [
                                        {name: 'id', type: 'int'},
                                        {name: 'alias', type: 'string'},
                                    ],
                                    data: owners
                                }),
                            },

                            {
                                xtype: 'combo', name: 'client_id', fieldLabel: 'Client', flex: 1, hidden: true,
                                forceSelection: true, editable: false, queryMode: 'local', triggerAction: 'all',
                                displayField: 'name', valueField: 'id', allowBlank: true,
                                store: Ext.create('Ext.data.Store', {
                                    fields: [
                                        {name: 'id', type: 'int'},
                                        {name: 'name', type: 'string'},
                                    ],
                                    data: [{id: null, name: '-'}].concat(clients)
                                }),
                            },

                            {
                                xtype: 'combo', name: 'vendor_id', fieldLabel: 'Area', flex: 1, hidden: true,
                                forceSelection: true, editable: false, queryMode: 'local', triggerAction: 'all',
                                displayField: 'name', valueField: 'id', allowBlank: true,
                                store: Ext.create('Ext.data.Store', {
                                    fields: [
                                        {name: 'id', type: 'int'},
                                        {name: 'name', type: 'string'},
                                    ],
                                    data: [{id: null, name: '-'}].concat(vendors)
                                }),
                                listeners: {
                                    change: function () {
                                        me.setField('fieldtech_id', null);
                                        me.getField('fieldtech_id').store.load();
                                    }
                                }
                            },

                            {
                                xtype: 'combo',
                                name: 'fieldtech_id',
                                fieldLabel: 'Team',
                                emptyText: 'Select Team',
                                forceSelection: true,
                                typeAhead: true,
                                hideTrigger: false,
                                allowBlank: true,
                                queryMode: 'remote',
                                minChars: 1,
                                triggerAction: 'all',
                                displayField: 'name',
                                valueField: 'id',
                                flex: 1,
                                hidden: true,
                                store: Ext.create('Ext.data.Store', {
                                    extend: 'Ext.data.Model',
                                    pageSize: 10,
                                    fields: [
                                        {name: 'id', type: 'int'},
                                        {name: 'name', type: 'name'},
                                    ],
                                    proxy: {type: 'ajax', url: '{{ route('auth.user.data.fieldtech') }}'},
                                    listeners: {
                                        beforeload: function (obj) {
                                            let vendor = me.getValue('vendor_id');
                                            Ext.apply(obj.getProxy().extraParams, {'vendor': vendor});
                                        }
                                    }
                                }),
                            },
                        ]
                    },

                    {
                        xtype: 'fieldcontainer', autoHeight: true,
                        layout: {type: 'hbox', align: 'stretch'},
                        fieldDefaults: {margin: 5},
                        items: [

                            {xtype: 'textfield', name: 'name', fieldLabel: 'Name', flex: 1},
                            {xtype: 'textfield', name: 'email', fieldLabel: 'Email', allowBlank: true, vtype: 'email', flex: 1},
                            {xtype: 'textfield', name: 'phone', fieldLabel: 'Phone', allowBlank: true, flex: 1},
                        ]
                    },

                    {xtype: 'textareafield', name: 'description', fieldLabel: 'Description', allowBlank:true, flex: 1, minHeight: 80, margin: 10,}
                ],
                buttons: [
                    { text: 'Save', iconCls: 'icon-save-bright', handler: me.save },
                    { text: 'Cancel', cls: 'btn-red', iconCls:'icon-close', handler: me.close }
                ]
            });

            me.createWindowForm('User Form', me.form, {maximized: true, header: false, title: "User"});
        };

        me.create = function(){
            me.show();
            me.reset();
            me.form.url = '{{ route('auth.user.push') }}';

            me.getField('password').allowBlank = false;
            me.getField('password').setValue('');
            me.getField('role_id').setValue(grids.extraParams.role);
            me.onSelectRole();
        }

        me.edit = function(){
            var rec = grids.getRec(true)
            if(rec){
                me.show();
                me.reset();
                me.form.url = '{{ route('auth.user.push') }}/' + rec.id;

                me.getField('password').allowBlank = true;

                me.setField('password', '');
                me.setField('role_id', rec.role_id); me.onSelectRole();
                me.setField('username', rec.username);
                me.setField('name', rec.name);
                me.setField('phone', rec.phone);
                me.setField('email', rec.email);
                me.setField('description', rec.description);

                me.setField('client_id', rec.client_id);
                me.setField('vendor_id', rec.vendor_id);

                if(rec.fieldtech) {
                    let fieldtech = forms.getField('fieldtech_id');
                    if (!isNull(fieldtech.store)) {
                        fieldtech.store.getProxy().extraParams = {
                            query: rec.fieldtech_id,
                            vendor: forms.getValue('vendor_id')
                        };
                        fieldtech.store.load(function () {
                            me.setField('fieldtech_id', rec.fieldtech.id);
                        });
                    }
                }

                me.setField('activities[]', rec.activities);
                me.setField('owners[]', rec.owners);


            }
            else Ext.example.msg('Warning!', 'Please select data!');
        }

        me.onSelectRole = function(prop){
            let client = me.getField('client_id');
            let vendor = me.getField('vendor_id');
            let ftech = me.getField('fieldtech_id');
            let activities = me.getField('activities[]');
            let owners = me.getField('owners[]');

            client.hide();
            vendor.hide();
            ftech.hide();
            activities.hide();
            owners.hide();

            me.setField('client_id', null);
            me.setField('vendor_id', null);
            me.setField('fieldtech_id', null);
            me.setField('activities[]', null);
            me.setField('owners[]', null);

            let role = me.getField('role_id');

            if(role.displayTplData.length || !isNull(prop)) {
                let rec = prop ? prop[0].data: role.displayTplData[0];
                if (rec && rec.properties && rec.properties.length) {
                    let properties = rec.properties;
                    if (properties && properties.length) {
                        if (find(properties, 'client')) client.show();
                        if (find(properties, 'vendor')) vendor.show();
                        if (find(properties, 'fieldtech')) ftech.show();
                        if (find(properties, 'activities')) activities.show();
                        if (find(properties, 'owners')) owners.show();
                    }
                }
            }
        }

        me.save = function(){
            me.submit(me.form.url, {success: grids.storeLoad});
        }
    }

</script>
