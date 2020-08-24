<?php


namespace App\Models\Traits;


trait WalletTransactionAttributesTrait
{
    /**
     * @param string|double|null $value
     * @return string|double|null
     */
    private function typeFormatNumber($value = null)
    {
        if (preg_match('(\d{1,3}(?:\.\d{3})*?,\d{2})', $value)) {
            $value = str_replace(',', '.', str_replace('.', '', $value));
        }
        return $value;
    }

    /**
     * @param string|double $value
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $this->typeFormatNumber($value);
    }
}
