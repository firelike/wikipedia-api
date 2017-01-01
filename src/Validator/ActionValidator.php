<?php
namespace Firelike\Wikipedia\Validator;


use Zend\Validator\AbstractValidator;
use Zend\Validator\InArray;

class ActionValidator extends AbstractValidator
{
    /**
     * @param string $value
     * @return bool
     */
    public function isValid($value)
    {
        $inArrayValidator = new InArray();

        $haystack = $this->getActions();
        $inArrayValidator->setHaystack($haystack);

        if (!$inArrayValidator->isValid($value)) {
            $this->setMessage(sprintf('invalid action provided: %s . expecting % s', $value, implode(' or ', $haystack)));
            return false;
        }

        return true;
    }

    private function getActions()
    {
        return [
            'abusefiltercheckmatch',
            'abusefilterchecksyntax',
            'abusefilterevalexpression',
            'abusefilterunblockautopromote',
            'addstudents',
            'antispoof',
            'block',
            'bouncehandler',
            'categorytree',
            'centralauthtoken',
            'centralnoticechoicedata',
            'centralnoticequerycampaign',
            'changeauthenticationdata',
            'checktoken',
            'cirrus-config-dump',
            'cirrus-mapping-dump',
            'cirrus-settings-dump',
            'clearhasmsg',
            'clientlogin',
            'compare',
            'createaccount',
            'cspreport',
            'cxconfiguration',
            'cxdelete',
            'cxpublish',
            'cxsave',
            'cxsuggestionlist',
            'cxtoken',
            'delete',
            'deleteeducation',
            'deleteglobalaccount',
            'echomarkread',
            'echomarkseen',
            'edit',
            'editmassmessagelist',
            'emailuser',
            'enlist',
            'expandtemplates',
            'fancycaptchareload',
            'featuredfeed',
            'feedcontributions',
            'feedrecentchanges',
            'feedwatchlist',
            'filerevert',
            'flagconfig',
            'globalblock',
            'globaluserrights',
            'graph',
            'help',
            'imagerotate',
            'import',
            'jsonconfig',
            'jsondata',
            'languagesearch',
            'linkaccount',
            'liststudents',
            'login',
            'logout',
            'managetags',
            'massmessage',
            'mergehistory',
            'mobileview',
            'move',
            'oathvalidate',
            'opensearch',
            'options',
            'pagetriageaction',
            'pagetriagelist',
            'pagetriagestats',
            'pagetriagetagging',
            'pagetriagetemplate',
            'paraminfo',
            'parse',
            'parsoid-batch',
            'patrol',
            'protect',
            'purge',
            'query',
            'refresheducation',
            'removeauthenticationdata',
            'resetpassword',
            'review',
            'reviewactivity',
            'revisiondelete',
            'rollback',
            'rsd',
            'sanitize-mapdata',
            'scribunto-console',
            'setglobalaccountstatus',
            'setnotificationtimestamp',
            'shortenurl',
            'sitematrix',
            'spamblacklist',
            'stabilize',
            'stashedit',
            'strikevote',
            'tag',
            'templatedata',
            'thank',
            'titleblacklist',
            'tokens',
            'transcodereset',
            'ulslocalization',
            'unblock',
            'undelete',
            'unlinkaccount',
            'upload',
            'userrights',
            'visualeditor',
            'visualeditoredit',
            'watch',
            'webapp-manifest',
            'wikilove',
            'zeroconfig'
        ];
    }

}