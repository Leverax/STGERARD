<table>
    <tr>
        <td colspan="6">STATISTIQUES DU : <?php echo e(date("d/m/Y" , strtotime($start_date)) .' AU '. date("d/m/Y" , strtotime($end_date))); ?> </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>INSCRITS</th>
            <th>SOLDE</th>
            <th>NON SOLDE</th>
            <th>ARRIERE</th>
            <th>MONTANT ARRIERE</th>
            <th>MONTANT ENCAISE</th>
            <th>RECETTES</th>
            <th>DEPENSES</th>
            <th>MONTANT DANS LA CAISSE</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo e($register); ?></td>
            <td><?php echo e($sold); ?></td>
            <td><?php echo e($unsold); ?></td>
            <td><?php echo e($backward ? $backward->count() : 0); ?></td>
            <td><?php echo e($backward ? \App\Helpers\FormatNumberToLetter::formatNumber($backward->sum('backward')).' F CFA' : 0); ?></td>
            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($amount).' F CFA'); ?></td>

            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($recipe->sum('amount')).' F CFA'); ?></td>
            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($expense->sum('amount')).' F CFA'); ?></td>
            <td><?php echo e(\App\Helpers\FormatNumberToLetter::formatNumber($amount + $recipe->sum('amount') - $expense->sum('amount')).' F CFA'); ?></td>
        </tr>
    </tbody>
</table><?php /**PATH C:\xampp\htdocs\csiledesroses\resources\views/exports/statistics.blade.php ENDPATH**/ ?>