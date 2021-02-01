<?php
namespace App\Models\Product;

interface OptionValueInterface
{
    /**
     * Get option.
     *
     * @return OptionInterface
     */
    public function getOption();

    /**
     * Set option.
     *
     * @param OptionInterface $option
     */
    public function setOption(OptionInterface $option = null);
}
