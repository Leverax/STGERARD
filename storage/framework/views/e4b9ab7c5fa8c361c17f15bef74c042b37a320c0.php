<table>
    <tr>
        <td colspan="6">AUTRES RECETTES DU : <?php echo e(date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date))); ?> </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>N°</th>
            <th>Motif</th>
            <th>Montant</th>
            <th>Année Académique</th>
            <th>Date de creation</th>
            <th>Par</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $recipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(++$key); ?></td>
                <td><?php echo e($recipe->motif); ?></td>
                <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($recipe->amount).' F CFA'); ?></td>
                <td><?php echo e($recipe->academic_years->name); ?></td>
                <td><?php echo e($recipe->created_at); ?></td>
                <td><?php echo e($recipe->users->lastname.' '.$recipe->users->firstname); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td colspan="5"></td>
        </tr>
        <tr>
            <td colspan="2">MONTANT TOTAL</td>
            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($recipes->sum('amount')).' F CFA'); ?></td>
            <td colspan="3"></td>
        </tr>

    </tbody>
</table><?php /**PATH C:\wamp64\www\review\cspyramides\resources\views/exports/recipe.blade.php ENDPATH**/ ?>