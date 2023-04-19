<?php

namespace MichelJonkman\DirectorExample;


use MichelJonkman\Director\Menu\Elements\MenuElement;

class MenuExportExampleText extends MenuElement
{
    protected string $typeName = 'TextElement';

    protected ?string $text = null;

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): MenuExportExampleText
    {
        $this->text = $text;

        return $this;
    }

    public function getComponentUrl(): string
    {
        return \Vite::asset('resources/js/Fieldtypes/TextElement.vue', 'director/example');
    }

    public function getData(): array
    {
        return array_merge(parent::getData(), [
            'text' => $this->getText()
        ]);
    }

    public function getValidationRules(): array
    {
        return array_merge(parent::getValidationRules(), [
            'text' => 'required'
        ]);
    }
}
