<?php
namespace gossi\codegen\generator\builder;

use gossi\codegen\generator\builder\parts\TypeBuilderPart;
use gossi\codegen\generator\builder\parts\ValueBuilderPart;
use gossi\codegen\model\AbstractModel;

class ParameterBuilder extends AbstractBuilder {
	
	use ValueBuilderPart;
	use TypeBuilderPart;

	public function build(AbstractModel $model) {
		$type = $this->getType($model, $this->config->getGenerateScalarTypeHints());
		if ($type !== null) {
            if ($this->config->getGenerateParameterTypeHints()) {
                $this->writer->write($type . ' ');
            }
		}
	
		if ($model->isPassedByReference()) {
			$this->writer->write('&');
		}
	
		$this->writer->write('$' . $model->getName());
	
		if ($model->hasValue()) {
			$this->writer->write(' = ');
	
			$this->writeValue($model);
		}
	}

}