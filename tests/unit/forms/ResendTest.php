<?php

namespace dektrium\user\tests\forms;

use dektrium\user\forms\Resend;
use dektrium\user\tests\_fixtures\UserFixture;
use yii\codeception\TestCase;

class ResendTest extends TestCase
{
    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/_fixtures/init_user.php'
            ],
        ];
    }

    public function testValidateEmail()
    {
        $form = new Resend();
        $user = $this->getFixture('user')->getModel('user');
        $form->setAttributes([
            'email' => $user->email,
        ]);
        $this->assertFalse($form->validate());

        $form = new Resend();
        $user = $this->getFixture('user')->getModel('unconfirmed');
        $form->setAttributes([
            'email' => $user->email,
        ]);
        $this->assertTrue($form->validate());
    }
}
