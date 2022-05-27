BX.ready(function() {
    if (window.location.href.includes('crm/deal/details')) {
        BX.ajax.load(
            {
                url: '/bitrix/components/bitrix/main.file.input/templates/.default/style.min.css',
                type: 'css'
            }
        );

        BX.addCustomEvent("onPullEvent-iitcompany.kpi", function(command, params) {
            BX.PopupWindowManager.create('popup-deal-stage', null, {
                autoHide: true,
                overlay: {
                    backgroundColor: 'black',
                    opacity: 500
                },
                lightShadow: true,
                closeIcon: true,
                closeByEsc: true,
                titleBar: 'Заполните поля по статусу',
                content: params.html,
                buttons: [
                    new BX.PopupWindowButton({
                        tag: 'span',
                        text: 'Сохранить', // текст кнопки
                        className: 'ui-btn ui-btn-success', // доп. классы
                        events: {
                            click() {
                                const container = this.popupWindow.contentContainer;
                                const errorContainer = container.querySelector('.error-container');
                                const form = container.querySelector('form');
                                const loader = new BX.Loader({
                                    target: container
                                });
                                let formData = new FormData(form);

                                loader.show();
                                formData.append('sessid', BX.bitrix_sessid());
                                formData.append('stageId', params.stageId);
                                formData.append('dealId', params.dealId);

                                fetch(form.action, {
                                    method: form.method,
                                    body: formData
                                }).then(
                                    (response) => {
                                        loader.destroy();

                                        if (response.status === 500) {
                                            showError(errorContainer, 'Ошибка в обработке данных на сервере');
                                        }

                                        response.json()
                                            .then((result) => {
                                                if (result.result === true) {
                                                    location.reload();
                                                } else {
                                                    showError(errorContainer, result.response);
                                                }
                                            });
                                    },
                                    (error) => {
                                        console.log(error);
                                        loader.destroy();
                                    }
                                );
                            }
                        }
                    }),
                ],
                events: {
                    onPopupClose() {
                        this.destroy();
                    },
                    onPopupShow() {
                        const form = this.contentContainer.querySelector('form');
                        const inputsFile = form.querySelectorAll('input[type="file"]');

                        if (inputsFile.length > 0) {
                            inputsFile.forEach(function(item) {
                                item.addEventListener('change', function() {
                                    let i = 0;
                                    let files = item.files;
                                    let len = files.length;
                                    let arFiles = [];
                                    let replaceButton = item.previousElementSibling;
                                    let list = item.closest('.field-wrap')
                                        .querySelector('.webform-field-upload-list');

                                    if (replaceButton.style.display === 'none' && files.length > 0) {
                                        replaceButton.style.display = 'block';
                                    } else if (replaceButton.style.display === 'block' && files.length <= 0) {
                                        replaceButton.style.display = 'none';
                                    }

                                    if (list) {
                                        for (; i < len; i++) {
                                            arFiles.push(BX.create({
                                                tag: 'li',
                                                text: files[i].name
                                            }))
                                        }

                                        BX.cleanNode(list);
                                        BX.adjust(list, {
                                            children: arFiles
                                        })
                                    }
                                })
                            })
                        }
                    },
                }
            }).show();
        });

        function showError(errorContainer, message) {
            BX.cleanNode(errorContainer);
            BX.adjust(errorContainer, {
                style: {
                    display: 'inline-block',
                },
                children: [
                    BX.create({
                        tag: 'span',
                        props: {
                            className: 'ui-entity-editor-field-error-text',
                        },
                        text: message
                    })
                ]
            });
        }
    }
})