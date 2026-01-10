import { LucideIcon } from 'lucide-react';

interface StatCardProps {
  title: string;
  value: number | string;
  icon: LucideIcon;
  iconBg: string;
  iconColor: string;
}

export default function StatCard({ title, value, icon: Icon, iconBg, iconColor }: StatCardProps) {
  return (
    <div className="bg-white rounded-lg shadow p-6">
      <div className="flex items-start justify-between mb-4">
        <h3 className="text-gray-600">{title}</h3>
        <div className={`${iconBg} ${iconColor} p-3 rounded-lg`}>
          <Icon className="w-6 h-6" />
        </div>
      </div>
      <div className="text-[#1e3a5f]">{value}</div>
    </div>
  );
}
